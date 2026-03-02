<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admission;
use App\Models\Tuition;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class TuitionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $admission = Admission::where('user_id', $user->id)->firstOrFail();
        $studentNumber = $admission->studentNumber;

        // Fetch all student payments from the payments table
        $tuitions = Payment::where('studentNumber', $studentNumber)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Summing up totals
        $totalAssessment = Tuition::where('studentNumber', $studentNumber)->sum(DB::raw('tuition_fee + misc_fees'));
        $totalPaid = Payment::where('studentNumber', $studentNumber)->where('status', 'completed')->sum('amount');

        return view('student.tuition.index', compact('tuitions', 'totalAssessment', 'totalPaid'));
    }

    public function store(Request $request)
{
    // 1. Pre-process the reference number to check uniqueness correctly
    $inputRef = $request->reference_number;
    $formattedRef = str_starts_with(strtoupper($inputRef), 'REF-') ? strtoupper($inputRef) : 'REF-' . strtoupper($inputRef);
    
    // Manually check uniqueness with the prefix included
    if (Payment::where('reference_number', $formattedRef)->exists()) {
        return redirect()->back()->withErrors(['reference_number' => 'This reference number has already been taken.'])->withInput();
    }

    $request->validate([
        'payment_method' => 'required|in:GCash,Bank Transfer',
        'amount' => 'required|numeric|min:1',
        'payment_proof' => 'required|file|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = Auth::user();
    $admission = Admission::where('user_id', $user->id)->firstOrFail();
    
    // 2. Fetch the tuition record to fix the "Field 'tuition_id' doesn't have a default value" error
    $tuition = Tuition::where('studentNumber', $admission->studentNumber)->firstOrFail();
    
    $file = $request->file('payment_proof');
    $encryptedContent = \App\Helpers\AESHelper::encrypt(file_get_contents($file->getRealPath()));

$filename = time() . '_' . $file->getClientOriginalName();

// Store the physical file in the 'receipts' folder
\Illuminate\Support\Facades\Storage::disk('local')->put('receipts/' . $filename, $encryptedContent);

Payment::create([
    'tuition_id'       => $tuition->id,
    'studentNumber'    => $admission->studentNumber,
    'amount'           => $request->amount,
    'reference_number' => $formattedRef,
    'receipt_path'     => $filename, 
    'status'           => 'pending',
    'approval_status'  => 'pending',
]);

    return redirect()->back()->with('success', 'Payment submitted successfully!');
}
}