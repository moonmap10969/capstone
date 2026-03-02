<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers\AESHelper;
use Illuminate\Http\Request;
use App\Models\Tuition;
use App\Models\Payment;
use App\Models\Enrollment;
use App\Models\Admission;
use App\Models\AcademicYear;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        // Use this for the dashboard cards (Totals)
        $baseQuery = Payment::with(['enrollment', 'tuition.academicYear']);

        // Apply Filters to the base query
        if ($request->filled('academic_year_id')) {
            $baseQuery->where('academic_year_id', $request->academic_year_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $baseQuery->where(function ($q) use ($search) {
                $q->where('studentNumber', 'like', "%{$search}%")
                ->orWhere('reference_number', 'like', "%{$search}%");
            });
        }

        // 1. Get the Dashboard Data (This stays a Collection for sum/count)
        $payments = $baseQuery->get(); 

        // 2. Get the Paginators for the two tabs
        $walkInPayments = (clone $baseQuery)->where('origin', 'cashier')
            ->latest()
            ->paginate(10, ['*'], 'walkin_page')
            ->appends($request->all());

        $studentSubmissions = (clone $baseQuery)->where('origin', 'student')
            ->latest()
            ->paginate(10, ['*'], 'student_page')
            ->appends($request->all());

        $academicYears = \App\Models\AcademicYear::pluck('year_range', 'id');

        return view('cashier.payments.index', compact(
            'walkInPayments', 
            'studentSubmissions', 
            'payments', 
            'academicYears'
        ));
    }
    public function create()
    {
        $students = Enrollment::with(['tuition.academicYear', 'admission'])
            ->whereHas('tuition')
            ->get()
            ->map(function($e) {
                return [
                    'enrollment_id'    => $e->id,
                    'tuition_id'       => $e->tuition->id,
                    'academic_year_id' => $e->tuition->academic_year_id, // Add this line
                    'studentNumber'    => $e->studentNumber,
                    'balance'          => $e->tuition->balance,
                    'studentFirstName' => $e->admission->studentFirstName ?? 'N/A',
                    'studentLastName'  => $e->admission->studentLastName ?? '',
                    'academic_year'    => $e->tuition->academicYear->year_range ?? 'N/A', 
                ];
            })
            ->keyBy('studentNumber'); 

        return view('cashier.payments.create', compact('students'));
    }


    public function store(Request $request)
    {
    // 1. Get the tuition
    $tuition = Tuition::find($request->tuition_id);

    if (!$tuition) {
        return back()->with('error', 'Tuition not found for this student.');
    }

    // 2. Determine remaining balance
    $totalPaid = $tuition->payments()->sum('amount');
    $remainingBalance = max(0, $tuition->amount - $totalPaid);

    // 3. Validate payment amount does not exceed remaining balance
    if ($request->amount > $remainingBalance) {
        return back()->with('error', "Payment cannot exceed remaining balance of ₱" . number_format($remainingBalance, 2));
    }

    // 4. Generate reference number with REF- prefix
    $referenceNumber = 'REF-' . ($request->reference_number ?? strtoupper(Str::random(8)));

    // 5. Handle receipt upload with AES encryption
    if ($request->hasFile('receipt')) {
        $file = $request->file('receipt');
        $contents = file_get_contents($file->getRealPath());       // read file content
        $encryptedContents = AESHelper::encrypt($contents);       // encrypt content
        $fileName = 'receipts/' . time() . '_' . $file->getClientOriginalName();
        file_put_contents(storage_path('app/' . $fileName), $encryptedContents); // save encrypted file
        $receiptPath = $fileName;
    } else {
        $receiptPath = 'receipts/placeholder.pdf';
    }

    // 6. Determine academic year
    $academicYearId = $request->academic_year_id 
                    ?? $tuition->academic_year_id 
                    ?? AcademicYear::where('is_current', 1)->value('id');

    // 7. Create the payment
    $payment = $tuition->payments()->create([
        'enrollment_id'    => $tuition->enrollment_id,
        'tuition_id'       => $tuition->id,
        'studentNumber'    => $tuition->studentNumber,
        'amount'           => min($request->amount, $tuition->balance), // don't allow overpayment
        'payment_method'   => $request->payment_method,
        'reference_number' => 'REF-' . ($request->reference_number ?? strtoupper(Str::random(8))),
        'origin'           => 'cashier',
        'status'           => 'completed',
        'approval_status'  => 'approved',
        'academic_year_id' => $academicYearId,
        'description'      => $request->description,
        'receipt_path'     => $receiptPath,
    ]);

    // 8. Reduce the tuition balance
    $tuition->balance -= $payment->amount;
    $tuition->save();

    return back()->with('success', 'Payment successfully recorded.');
    }

    // 2. Updated Approve Method (For Online Submissions)
    public function approveOnline($id)
    {
        $payment = Payment::findOrFail($id);
        
        // Find the specific tuition record for this student's specific admission
        $tuition = Tuition::where('admission_id', $payment->admission_id)->firstOrFail();

        if ($payment->status !== 'completed') {
            DB::transaction(function () use ($payment, $tuition) {
                $tuition->increment('paid_amount', $payment->amount);
                $tuition->decrement('balance', $payment->amount);
                
                $tuition->update([
                    'status' => $tuition->balance <= 0 ? 'paid' : 'partial'
                ]);

                $payment->update([
                    'status' => 'completed', 
                    'approval_status' => 'approved'
                ]);
            });
        }
        return redirect()->back()->with('success', 'Payment verified and balance updated.');
    }

        public function reject(Request $request, $id)
        {
            $request->validate(['remarks' => 'required|string|max:255']);
            $payment = Payment::findOrFail($id);
            $payment->update([
                'status' => 'rejected',
                'remarks' => $request->remarks,
                'approval_status' => 'rejected'
            ]);
            return redirect()->back()->with('success', 'Payment rejected with remarks.');
        }

    public function show($id)
    {
        $payment = Payment::findOrFail($id);

        // 1. Handle Cash Receipts
        if ($payment->receipt_path === 'CASH_PAYMENT' || $payment->payment_method === 'cash') {
            $student = \App\Models\Admission::where('studentNumber', $payment->studentNumber)->first();
            $name = $student ? "{$student->studentFirstName} {$student->studentLastName}" : "Unknown Student";
            
            return response("
                <div style='font-family:sans-serif; max-width:400px; margin:50px auto; padding:30px; border:2px solid #e2e8f0; border-radius:20px; text-align:center;'>
                    <h2 style='color:#15803d;'>FUMCES OFFICIAL RECEIPT</h2>
                    <hr style='border:none; border-top:1px dashed #cbd5e1; margin:20px 0;'>
                    <div style='text-align:left; line-height:2;'>
                        <p><b>Ref:</b> {$payment->reference_number}</p>
                        <p><b>Student:</b> {$name}</p>
                        <p><b>Amount:</b> ₱" . number_format($payment->amount, 2) . "</p>
                        <p><b>Date:</b> " . $payment->created_at->format('M d, Y') . "</p>
                    </div>
                    <button onclick='window.print()' style='margin-top:20px; padding:10px 20px; background:#15803d; color:white; border:none; border-radius:10px; cursor:pointer;'>Print Receipt</button>
                </div>
            ", 200)->header('Content-Type', 'text/html');
        }

                // 2. Handle Online Receipts
                $dbPath = $payment->receipt_path;

                $fullPath = str_contains($dbPath, 'receipts/')
                    ? $dbPath
                    : "receipts/" . $dbPath;

                // Make sure file exists
                if (!Storage::disk('local')->exists($fullPath)) {
                    abort(404, "Receipt file not found.");
                }

                // Get encrypted file
                $encryptedContent = Storage::disk('local')->get($fullPath);

                // Decrypt it
                $decryptedContent = AESHelper::decrypt($encryptedContent);

                // Detect real image type (IMPORTANT because your files end in .dat)
                $finfo = new \finfo(FILEINFO_MIME_TYPE);
                $contentType = $finfo->buffer($decryptedContent);

                return response($decryptedContent, 200)
                    ->header('Content-Type', $contentType);
    }
        public function download($id)
        {
            $payment = Payment::findOrFail($id);
            if (!$payment->receipt_path || !Storage::disk('local')->exists($payment->receipt_path)) abort(404);
            
            $decryptedContent = AESHelper::decrypt(Storage::disk('local')->get($payment->receipt_path));
            return response($decryptedContent, 200)
                ->header('Content-Type', 'application/octet-stream')
                ->header('Content-Disposition', "attachment; filename=\"receipt_{$payment->reference_number}.jpg\"");
        }
    }