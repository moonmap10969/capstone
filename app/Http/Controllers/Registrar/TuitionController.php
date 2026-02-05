<?php

namespace App\Http\Controllers\Registrar; // Updated Namespace

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tuition;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TuitionController extends Controller
{
    public function index()
    {
        $tuitions = Tuition::orderBy('id', 'asc')->paginate(10);

        $totalPending      = Tuition::where('status', 'pending')->count();
        $paymentsPartial   = Tuition::where('payment_type', 'partial')->count();
        $paymentsCompleted = Tuition::where('payment_type', 'paid')->count();
        $totalStudents     = Tuition::distinct('studentNumber')->count();

        // Updated view path to registrar
        return view('registrar.tuitions.index', compact(
            'tuitions',
            'totalPending',
            'paymentsPartial',
            'paymentsCompleted',
            'totalStudents'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'       => 'required',
            'student_name'     => 'required|string|max:255',
            'amount'           => 'required|numeric|min:0',
            'reference_number' => 'nullable|string|max:255',
            'payment_method'   => 'required|in:gcash,bank_transfer,cash',
            'payment_proof'    => $request->payment_method === 'cash' ? 'nullable' : 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $filePath = null;
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('payment_proofs', $fileName, 'public');
        }

        Tuition::create([
            'studentNumber'       => $request->student_id,
            'name'     => $request->student_name,
            'amount'           => $request->amount,
            'reference_number' => $request->reference_number,
            'payment_method'   => $request->payment_method,
            'payment_proof'    => $filePath,
            'status'           => 'pending',
            'payment_type'     => 'partial',
        ]);

        return redirect()->back()->with('success', 'Tuition record added successfully!');
    }

    public function update(Request $request, Tuition $tuition)
    {
        $request->validate([
            'studentNumber'       => 'required',
            'name'     => 'required|string|max:255',
            'amount'           => 'required|numeric|min:0',
            'reference_number' => 'nullable|string|max:255',
            'payment_method'   => 'required|in:gcash,bank_transfer,cash',
            'status'           => 'required|in:pending,approved,rejected',
            'payment_type'     => 'required|in:paid,partial,unpaid',
            'payment_proof'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $data = $request->except('payment_proof');

        if ($request->hasFile('payment_proof')) {
            if ($tuition->payment_proof) {
                Storage::disk('public')->delete($tuition->payment_proof);
            }
            $file = $request->file('payment_proof');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $data['payment_proof'] = $file->storeAs('payment_proofs', $fileName, 'public');
        }

        $tuition->update($data);

        // Updated redirect to registrar route
        return redirect()->route('registrar.tuitions.index')->with('success', 'Tuition record updated successfully!');
    }

    public function destroy(Tuition $tuition)
    {
        if ($tuition->payment_proof) {
            Storage::disk('public')->delete($tuition->payment_proof);
        }

        $tuition->delete();
        return redirect()->back()->with('success', 'Tuition record deleted successfully!');
    }

    public function approve(Tuition $tuition)
    {
        $tuition->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Tuition payment approved!');
    }

    public function reject(Tuition $tuition)
    {
        $tuition->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Tuition payment rejected!');
    }
}