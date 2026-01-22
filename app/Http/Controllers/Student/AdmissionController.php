<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdmissionController extends Controller
{
    public function index()
    {
        $admission = auth()->user()->admission;

        // Define the steps array to ensure 'title' and 'date' keys exist
        $steps = [
            ['title' => 'Application Submitted', 'date' => $admission?->created_at?->format('M d, Y') ?? 'N/A'],
            ['title' => 'Document Verification', 'date' => $admission?->status === 'approved' ? 'Completed' : 'Pending'],
            ['title' => 'Admission Confirmed', 'date' => $admission?->student_number ? 'Finalized' : 'Waiting'],
        ];

        return view('student.admissions.index', compact('admission', 'steps'));
    }

   public function create()
{
    return view('admissions');
}

public function store(Request $request)
{
    // 1. Validate all fields sent from your Blade form
    $validated = $request->validate([
        'studentFirstName' => 'required|string|max:255',
        'studentLastName' => 'required|string|max:255',
        'dateOfBirth' => 'required|date',
        'gradeApplying' => 'required|string',
        'parentFirstName' => 'required|string|max:255',
        'parentLastName' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'zipCode' => 'required|string|max:10',
        'birthCertificate' => 'required|file|mimes:pdf,jpg,png|max:10240',
        'immunizationRecords' => 'required|file|mimes:pdf,jpg,png|max:10240',
        'reportCard' => 'required|file|mimes:pdf,jpg,png|max:10240',
        'goodMoral' => 'required|file|mimes:pdf,jpg,png|max:10240',
    ]);

    $appId = 'APP-' . strtoupper(uniqid());

    // 2. Map the validated keys to your database columns
    $admission = \App\Models\Admission::create([
        'user_id' => Auth::id(), 
        'application_id' => $appId,
        'student_first_name' => $validated['studentFirstName'], // Key must match validation
        'student_last_name' => $validated['studentLastName'],
        'date_of_birth' => $validated['dateOfBirth'],
        'grade_applied' => $validated['gradeApplying'],
        'parent_first_name' => $validated['parentFirstName'],
        'parent_last_name' => $validated['parentLastName'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'street' => $validated['address'],
        'city' => $validated['city'],
        'state' => $validated['state'],
        'zip' => $validated['zipCode'],
        'birth_certificate' => $request->file('birthCertificate')->store('documents', 'public'),
        'immunization_records' => $request->file('immunizationRecords')->store('documents', 'public'),
        'report_card' => $request->file('reportCard')->store('documents', 'public'),
        'good_moral' => $request->file('goodMoral')->store('documents', 'public'),
        'status' => 'pending',
    ]);

    Mail::to($validated['email'])->send(new \App\Mail\ApplicationSubmitted($admission));

    return redirect()->route('success-card')->with([
        'status' => 'submitted',
        'appId' => $appId
    ]);
}
}