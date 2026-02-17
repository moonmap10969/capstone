<?php

namespace App\Http\Controllers\Admissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admission;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentNumberGenerated;
use App\Mail\AdmissionRejectedMail;
use App\Models\Document;
use App\Mail\AdmissionApprovedMail;

class AdmissionsAdmissionController extends Controller
{
    public function index()
    {
        $admissions = Admission::paginate(10); 
        
        $grades = Admission::select('year_level')->distinct()->pluck('year_level');
        $totalPendingApprovals = Admission::where('status', 'pending')->count();
        $totalApproved = Admission::where('status', 'approved')->count();
        $totalRejected = Admission::where('status', 'rejected')->count();
        $totalStudentsRegistered = Admission::count();

        return view('admissions.admissions.index', compact(
            'admissions', 'grades', 'totalPendingApprovals', 
            'totalApproved', 'totalRejected', 'totalStudentsRegistered'
        ));
    }

    public function show(Admission $admission)
    {
        return view('admissions.admissions.show', compact('admission'));
    }

    public function approve(Request $request, Admission $admission)
    {
        // 1. Retrieve the user associated with the admission
        $user = $admission->user;

        // 2. Safety Check: Avoid "trying to access offset on null" if user record is missing
        if (!$user) {
            return back()->with('error', 'Associated user account not found. Cannot approve.');
        }

        // 3. Generate Student Number (Logic merged)
        $studentNumber = 'SN-' . date('Y') . '-' . str_pad($admission->id, 4, '0', STR_PAD_LEFT);

        // 4. Update Admission status and save the ID
        $admission->update([
            'status' => 'approved',
            'studentNumber' => $studentNumber
        ]);

        // 5. Update User Role and Details
        $user->update([
            'is_approved' => true,
            'role' => 'student', 
            'year_level' => $admission->year_level,
        ]);

        // 6. Send Email Notification
        if ($user->email) {
            Mail::to($user->email)->send(new AdmissionApprovedMail($studentNumber, $user));
        }

        return back()->with('success', 'Admission approved and Student ID generated successfully.');
    }

    public function reject(Admission $admission) 
    {
        $admission->update(['status' => 'rejected']);

        // Send rejection email
        Mail::to($admission->email)->send(new AdmissionRejectedMail($admission));

        return back()->with('success', 'Application rejected and email sent.');
    }

    public function create()
    {
        return view('admissions.admissions.create');
    }
}