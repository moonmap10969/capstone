<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Fixes the "Undefined type 'DB'" error

class PaymentController extends Controller
{
    public function store(Request $request)
{
    // 1. Validate the form inputs
    $request->validate([
        'student_number' => 'required',
        'reference_number' => 'required|unique:payments,reference_number',
        'amount' => 'required|numeric|min:1',
        'payment_method' => 'required',
        'receipt' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // 2. Handle the file upload
    $path = $request->file('receipt')->store('receipts', 'public');

   
   DB::table('payments')->insert([
    'student_number'   => $request->student_number,
    'reference_number' => $request->reference_number,
    'amount'           => $request->amount,
    'payment_method'   => $request->payment_method,
    'description'      => $request->description,
    'receipt_path'     => $path,
    'status'           => 'pending',
    'created_at'       => now(),
    'updated_at'       => now(),
]);

    // 4. Update the total tuition amount (or paid_amount)
    DB::table('tuitions')
        ->where('student_number', $request->student_number)
        ->increment('amount', $request->amount);

    return redirect()->route('student.tuitions.index')->with('success', 'Payment submitted for verification!');
}
}