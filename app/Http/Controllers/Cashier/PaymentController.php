<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Helpers\AESHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Tuition;
use App\Models\Payment;
use App\Models\Admission;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
 public function index(Request $request)
{
    $query = Admission::leftJoin('tuitions', 'admissions.studentNumber', '=', 'tuitions.studentNumber')
        ->select(
            'admissions.studentNumber',
            'admissions.studentFirstName',
            'admissions.studentLastName',
            'tuitions.id as tuition_id', // Alias this clearly
            'tuitions.paid_amount',
            'tuitions.balance',
            'tuitions.status',
            'tuitions.payment_method'
        );

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('admissions.studentNumber', 'like', "%{$search}%")
              ->orWhere('admissions.studentLastName', 'like', "%{$search}%")
              ->orWhere('admissions.studentFirstName', 'like', "%{$search}%");
        });
    }

    $tuitions = $query->orderBy('admissions.studentLastName', 'asc')->paginate(10);
    $totalCollected = Tuition::sum('paid_amount');
    $totalBalance = Tuition::sum('balance');

    // FIX: Define the variable causing your error
    $transactionHistory = Payment::orderBy('created_at', 'desc')->limit(5)->get();

    return view('cashier.payments.index', compact('tuitions', 'totalCollected', 'totalBalance', 'transactionHistory'));
}
    /*
    |--------------------------------------------------------------------------
    | APPROVE ONLINE PAYMENT
    |--------------------------------------------------------------------------
    */
    public function approveOnline($id)
    {
        $tuition = Tuition::findOrFail($id);

        // 1. Update the Main Tuition Record (Balance/Status)
        $tuition->balance -= $tuition->amount;
        $tuition->paid_amount += $tuition->amount;
        $tuition->status = $tuition->balance <= 0 ? 'paid' : 'partial';
        $tuition->save();

        // 2. Create the Official Payment Record
        $newPayment = new Payment();
        $newPayment->studentNumber = $tuition->studentNumber;
        $newPayment->amount = $tuition->amount;
        $newPayment->payment_method = $tuition->payment_method;
        $newPayment->reference_number = $tuition->reference_number;
        $newPayment->status = 'completed';
        $newPayment->approval_status = 'approved';

        // 3. Migrate & Encrypt the Student's Receipt
        if ($tuition->payment_proof && Storage::disk('public')->exists($tuition->payment_proof)) {
            $content = Storage::disk('public')->get($tuition->payment_proof);
            $encryptedContent = AESHelper::encrypt($content);
            $extension = pathinfo($tuition->payment_proof, PATHINFO_EXTENSION);
            
            $newPath = 'receipts/' . $tuition->studentNumber . '_' . time() . '.' . $extension . '.dat';
            Storage::disk('local')->put($newPath, $encryptedContent);
            
            $newPayment->receipt_path = $newPath;
            
            // Clean up the temporary public file
            Storage::disk('public')->delete($tuition->payment_proof);
        }

        $newPayment->save();

        return redirect()->back()->with('success', 'Online payment approved and record encrypted.');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE PAYMENT (WALK-IN)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'studentNumber' => 'required',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5000'
        ]);

        $tuition = Tuition::where('studentNumber', $request->studentNumber)->first();

        if (!$tuition) {
            return redirect()->back()->with('error', 'No tuition record found.');
        }

        $tuition->balance -= $request->amount;
        $tuition->paid_amount += $request->amount;
        $tuition->status = $tuition->balance <= 0 ? 'paid' : 'partial';
        $tuition->save();

        $newPayment = new Payment();
        $newPayment->studentNumber = $request->studentNumber;
        $newPayment->amount = $request->amount;
        $newPayment->payment_method = $request->payment_method;
        $newPayment->status = 'completed';
        $newPayment->approval_status = 'approved';
        $newPayment->reference_number = 'REF-' . time() . '-' . Str::random(5);

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $content = file_get_contents($file);
            $encryptedContent = AESHelper::encrypt($content);
            $extension = $file->getClientOriginalExtension();
            $path = 'receipts/' . $request->studentNumber . '_' . time() . '.' . $extension . '.dat';
            Storage::disk('local')->put($path, $encryptedContent);
            $newPayment->receipt_path = $path;
        }

        $newPayment->save();

        return redirect()->route('cashier.payments.index')->with('success', 'Payment processed and file encrypted.');
    }

    public function show($id)
    {
        $payment = Payment::findOrFail($id);

        if (!$payment->receipt_path || !Storage::disk('local')->exists($payment->receipt_path)) {
            abort(404, 'Receipt not found.');
        }

        $encryptedContent = Storage::disk('local')->get($payment->receipt_path);
        $decryptedContent = AESHelper::decrypt($encryptedContent);

        $filename = pathinfo($payment->receipt_path, PATHINFO_FILENAME); 
        $extension = pathinfo($filename, PATHINFO_EXTENSION); 

        $mimeType = match(strtolower($extension)) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'pdf' => 'application/pdf',
            default => 'application/octet-stream'
        };

        return response($decryptedContent, 200)
               ->header('Content-Type', $mimeType)
               ->header('Content-Disposition', 'inline; filename="receipt.' . $extension . '"');
    }

   

    public function destroy(Tuition $tuition)
    {
        $tuition->delete();
        return back()->with('success', 'Tuition record deleted.');
    }
    
    public function edit($id)
    {
        // We use Tuition here because the index/edit flow is based on the Tuition ledger
        $tuition = Tuition::leftJoin('admissions', 'tuitions.studentNumber', '=', 'admissions.studentNumber')
            ->select('tuitions.*', 'admissions.studentFirstName', 'admissions.studentLastName')
            ->findOrFail($id);

        return view('cashier.payments.edit', compact('tuition'));
    }
    

    public function create()
    {
        $students = Admission::with('tuition')->get()->map(function ($student) {
            return [
                'id' => $student->studentNumber,
                'name' => $student->studentFirstName . ' ' . $student->studentLastName,
                'balance' => $student->tuition->balance ?? 0,
            ];
        })->keyBy('id');

        return view('cashier.payments.create', compact('students'));
    }

    public function searchStudent(Request $request)
    {
        $student = Admission::where('studentNumber', $request->query)
            ->with('tuition')
            ->first();

        if (!$student) {
            return response()->json(['exists' => false]);
        }

        return response()->json([
            'exists' => true,
            'name' => $student->studentFirstName . ' ' . $student->studentLastName,
            'balance' => $student->tuition->balance ?? 0
        ]);
    }

    public function setPayment(Tuition $tuition)
    {
        $tuition->status = 'paid';
        $tuition->balance = 0;
        $tuition->save();

        return back()->with('success', 'Payment set successfully.');
    }
}