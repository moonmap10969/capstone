<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Tuition;
use App\Models\User; // or Student model if you have one
use Illuminate\Http\Request;

class TuitionController extends Controller
{
public function index()
{
    $tuitions = Tuition::orderBy('id', 'asc')->paginate(10);

    // Stats
    $totalPending = Tuition::where('status', 'pending')->count();

    $paymentsPartial = Tuition::where('payment_type', 'partial')
                              ->where('status', 'approved')
                              ->count();

    $paymentsCompleted = Tuition::whereIn('payment_type', ['paid', 'full'])
                                ->where('status', 'approved')
                                ->count();

    $totalStudents = Tuition::distinct('studentNumber')->count('studentNumber');

    // Fully Paid Students grouped by student
    $fullyPaid = Tuition::select('studentNumber', 'name')
                        ->where('status', 'approved')
                        ->whereIn('payment_type', ['paid', 'full'])
                        ->groupBy('studentNumber', 'name')
                        ->get()
                        ->map(function($t) {
                            $t->amount = Tuition::where('studentNumber', $t->studentNumber)
                                                ->where('status', 'approved')
                                                ->sum('amount');
                            $t->payment_type = 'Paid';
                            return $t;
                        });

    // Students With Balance grouped by student
    $withBalance = Tuition::select('studentNumber', 'name')
                          ->where('status', 'approved')
                          ->where('payment_type', 'partial')
                          ->groupBy('studentNumber', 'name')
                          ->get()
                          ->map(function($t) {
                              $t->amount = Tuition::where('studentNumber', $t->studentNumber)
                                                  ->where('status', 'approved')
                                                  ->sum('amount');
                              $t->balance = 15738 - $t->amount; // adjust full tuition as needed
                              $t->payment_type = 'Partial';
                              return $t;
                          });

    return view('cashier.tuitions.index', compact(
        'tuitions',
        'totalPending',
        'paymentsPartial',
        'paymentsCompleted',
        'totalStudents',
        'fullyPaid',
        'withBalance'
    ));
}
        
    public function approve(Tuition $tuition)
    {
        // Approve the tuition
        $tuition->status = 'approved';
    
        // Automatically mark full payment if amount matches the total tuition
        // Adjust 15738 to your actual full tuition amount if needed
        if ($tuition->amount >= 15738) {
            $tuition->payment_type = 'paid';
        }
    
        $tuition->save();
    
        return redirect()->back()->with('success', 'Tuition payment approved!');
    }
    
    public function update(Request $request, $id)
{
    $tuition = Tuition::findOrFail($id);

    $request->validate([
        'student_id' => 'required|string',
        'student_name' => 'required|string',
        'amount' => 'required|numeric',
        'payment_method' => 'required|string',
        'payment_type' => 'required|string',
        'status' => 'required|string',
        'reference_number' => 'nullable|string',
        'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf'
    ]);

    $tuition->studentNumber = $request->student_id;
    $tuition->name = $request->student_name;
    $tuition->amount = $request->amount;
    $tuition->payment_method = $request->payment_method;
    $tuition->payment_type = $request->payment_type;
    $tuition->status = $request->status;
    $tuition->reference_number = $request->reference_number;

    // Handle file upload
    if ($request->hasFile('payment_proof')) {
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');
        $tuition->payment_proof = $path;
    }

    $tuition->save();

    return redirect()
        ->route('cashier.tuitions.index')
        ->with('success', 'Tuition record updated successfully.');
}



    
}
