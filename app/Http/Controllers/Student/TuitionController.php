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

        // Fetch both student-submitted (Tuition) and office-recorded (Payment) records
        $tuitions = Tuition::where('studentNumber', $studentNumber)
            ->whereIn('status', ['pending', 'approved', 'rejected'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $cashierPayments = Payment::where('studentNumber', $studentNumber)
            ->where('approval_status', 'approved')
            ->get();

        // Calculate Totals
        $totalAssessment = Tuition::where('studentNumber', $studentNumber)->sum(DB::raw('tuition_fee + misc_fees'));
        
        $totalPaid = Tuition::where('studentNumber', $studentNumber)->where('status', 'approved')->sum('amount') +
                     $cashierPayments->sum('amount');

        return view('student.tuition.index', compact('tuitions', 'cashierPayments', 'totalAssessment', 'totalPaid'));
    }

    public function store(Request $request)
{
    $request->validate([
        'payment_method' => 'required|in:GCash,Bank Transfer',
        'amount_type' => 'required|in:Partial,Full',
        'amount' => 'required|numeric|min:1',
        'reference_number' => 'required|string|unique:tuitions,reference_number',
        'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $user = Auth::user();
    $admission = Admission::where('user_id', $user->id)->firstOrFail();
    $path = $request->file('payment_proof')->store('receipts', 'public');

    Tuition::create([
        'studentNumber' => $admission->studentNumber,
        'name' => $user->name, // This fixes the SQL error
        'payment_method' => $request->payment_method,
        'amount_type' => $request->amount_type,
        'amount' => $request->amount,
        'reference_number' => $request->reference_number,
        'payment_proof' => $path,
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'Payment submitted to Cashier successfully!');
}
}