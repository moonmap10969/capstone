<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admission;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentNumberGenerated;
use App\Mail\AdmissionRejectedMail;

class AdmissionController extends Controller
{
  public function index()
{

    $admissions = Admission::paginate(10); 
    
    $grades = Admission::select('year_level')->distinct()->pluck('year_level');
    $totalPendingApprovals = Admission::where('status', 'pending')->count();
    $totalApproved = Admission::where('status', 'approved')->count();
    $totalRejected = Admission::where('status', 'rejected')->count();
    $totalStudentsRegistered = Admission::count();

    return view('admin.admissions.index', compact(
        'admissions', 'grades', 'totalPendingApprovals', 
        'totalApproved', 'totalRejected', 'totalStudentsRegistered'
    ));
}

    public function show(Admission $admission)
    {
        return view('admin.admissions.show', compact('admission'));
    }

    public function approve(Admission $admission)
    {
        $studentNumber = date('Y') . str_pad($admission->id, 5, '0', STR_PAD_LEFT);
        
        $admission->update([
            'status' => 'approved',
            'student_number' => $studentNumber,
            'password' => bcrypt($studentNumber),
        ]);

        Mail::to($admission->email)->send(new StudentNumberGenerated($studentNumber));

        return back()->with('success', "Student approved. Number: $studentNumber");
    }

   public function reject(Admission $admission) {
    $admission->update(['status' => 'rejected']);

    $details = [
        'subject' => 'Notification Regarding Your Admission Application',
        'body' => "We regret to inform you that after careful review, we are unable to proceed with your application at this time. We sincerely apologize for any inconvenience this may cause and appreciate the interest you have shown in our institution.",
        'contact' => "Should you have any questions regarding this decision, please contact our Admissions Office at (045) 123-4567 or email us at admissions@school.edu.ph."
    ];

   Mail::to($admission->email)->send(new AdmissionRejectedMail($admission));

    return back()->with('success', 'Application rejected and email sent.');
}
}