<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdmissionApproved;

class AdmissionController extends Controller
{
    /**
     * Display a listing with search and filters.
     */
    public function index(Request $request)
    {
        $query = Admission::query();

        // Search by Name or Application ID
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('student_first_name', 'like', "%{$search}%")
                  ->orWhere('student_last_name', 'like', "%{$search}%")
                  ->orWhere('application_id', 'like', "%{$search}%");
            });
        }

        // Filter by Grade
        if ($request->filled('grade')) {
            $query->where('grade_applied', $request->grade);
        }

        $admissions = $query->latest()->paginate(10);

        // Stats for Dashboard
        $totalPendingApprovals = Admission::where('status', 'document_verification')->count();
        $totalApproved = Admission::where('status', 'approved')->count();
        $totalRejected = Admission::where('status', 'rejected')->count();
        $totalStudentsRegistered = Admission::count();

        $grades = Admission::select('grade_applied')->distinct()->orderBy('grade_applied')->pluck('grade_applied');

        return view('admin.admissions.index', compact(
            'admissions', 'totalPendingApprovals', 'totalApproved', 
            'totalRejected', 'totalStudentsRegistered', 'grades'
        ));
    }

public function approve($id)
{
    $admission = \App\Models\Admission::findOrFail($id);
    $studentNumber = date('Y') . rand(1000, 9999);

    $admission->update([
        'status' => 'approved',
        'student_number' => $studentNumber
    ]);

    // Create or update the student's login account
    \App\Models\User::updateOrCreate(
        ['email' => $admission->email],
        [
            'name' => $admission->student_first_name . ' ' . $admission->student_last_name,
            'username' => $studentNumber,
            'password' => \Illuminate\Support\Facades\Hash::make($studentNumber),
            'role' => 'student', 
        ]
    );

    \Illuminate\Support\Facades\Mail::to($admission->email)
        ->send(new \App\Mail\ApplicationSubmitted($admission));

    return back()->with('success', 'Application approved! Student login is now active.');
}


    public function edit(Admission $admission)
{
    return view('admin.admissions.edit', compact('admission'));
}
    public function reject($id)
    {
        $application = Admission::findOrFail($id);
        $application->update(['status' => 'rejected']);

        return redirect()->back()->with('error', 'Admission rejected.');
    }
}