<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tuition;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TuitionController extends Controller
{
public function index()
{
    $user = Auth::user();

    // Check if studentNumber exists; use lengthAwarePaginator via paginate(0) for consistency
    if (!$user || empty($user->studentNumber)) {
        return view('student.tuition.index', [
            'tuitions' => \App\Models\Tuition::where('id', 0)->paginate(10), // Returns empty Paginator
            'totalPaid' => 0,
            'pendingCount' => 0
        ])->with('error', 'Student Profile incomplete. Student ID is missing.');
    }

    $tuitions = Tuition::where('studentNumber', $user->studentNumber)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
                

        $totalPaid = Tuition::where('studentNumber', $user->studentNumber)
                    ->where('status', 'approved')
                    ->sum('amount');

        $pendingCount = Tuition::where('studentNumber', $user->studentNumber)
                    ->where('status', 'pending')
                    ->count();

        return view('student.tuition.index', compact('tuitions', 'totalPaid', 'pendingCount'));
    }

    public function store(Request $request)
    {
        // 1. Validate with custom messages so you know exactly what failed
        $request->validate([
            'amount'           => 'required|numeric|min:1',
            'reference_number' => 'nullable|string|max:255',
            'payment_method'   => 'required|in:gcash,bank_transfer,cash',
            'payment_proof'    => $request->payment_method === 'cash' 
                                  ? 'nullable' 
                                  : 'required|file|mimes:jpg,jpeg,png,pdf|max:5120', // Increased to 5MB
        ]);

        // 2. Extra Safety: Check if User actually has a studentNumber before creating
        if (empty(Auth::user()->studentNumber)) {
            return redirect()->back()->withErrors(['studentNumber' => 'Your account is not linked to a Student ID. Submission blocked.'])->withInput();
        }

        $filePath = null;
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            // Store in the 'public' disk
            $filePath = $file->storeAs('payment_proofs', $fileName, 'public');
        }

        // 3. Create the record
        try {
            Tuition::create([
                'studentNumber'       => Auth::user()->studentNumber,
                'name'     => Auth::user()->name, 
                'amount'           => $request->amount,
                'reference_number' => $request->reference_number,
                'payment_method'   => $request->payment_method,
                'payment_proof'    => $filePath,
                'status'           => 'pending', 
                'payment_type'     => 'partial', 
            ]);

            return redirect()->route('student.tuition.index')->with('success', 'Payment submitted successfully!');
        } catch (\Exception $e) {
            // If the database crashes, this will show you why
            return redirect()->back()->with('error', 'Database Error: ' . $e->getMessage())->withInput();
        }
    }
}