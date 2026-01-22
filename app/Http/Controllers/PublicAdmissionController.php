<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PublicAdmissionController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'studentFirstName' => 'required|string|max:255',
        'studentLastName'  => 'required|string|max:255',
        'dateOfBirth'      => 'required|date',
        'gradeApplying'    => 'required|string|max:50',
        'parentFirstName'  => 'required|string|max:255',
        'parentLastName'   => 'required|string|max:255',
        'email'            => 'required|email|max:255',
        'phone'            => 'required|string|max:50',
        'address'          => 'required|string|max:255',
        'city'             => 'required|string|max:100',
        'state'            => 'required|string|max:100',
        'zipCode'          => 'required|string|max:20',
        // Document Validations
        'birthCertificate'      => 'required|file|mimes:pdf,jpg,png|max:10240',
        'immunizationRecords'   => 'required|file|mimes:pdf,jpg,png|max:10240',
        'previousSchoolRecords' => 'nullable|file|mimes:pdf,jpg,png|max:10240',
        'proofOfResidency'      => 'required|file|mimes:pdf,jpg,png|max:10240',
    ]);

    $applicationId = 'APP-' . strtoupper(Str::random(6));
    
    // Prepare data array
    $data = [
        'application_id'     => $applicationId,
        'student_first_name' => $validated['studentFirstName'],
        'student_last_name'  => $validated['studentLastName'],
        'date_of_birth'      => $validated['dateOfBirth'],
        'grade_applied'      => $validated['gradeApplying'],
        'parent_first_name'  => $validated['parentFirstName'],
        'parent_last_name'   => $validated['parentLastName'],
        'email'              => $validated['email'],
        'phone'              => $validated['phone'],
        'street'             => $validated['address'],
        'city'               => $validated['city'],
        'state'              => $validated['state'],
        'zip'                => $validated['zipCode'],
        'status'             => 'document_verification',
    ];

    // Map file inputs to database columns and store files
    $files = [
        'birthCertificate'      => 'birth_certificate',
        'immunizationRecords'   => 'immunization_records',
        'previousSchoolRecords' => 'previous_school_records',
        'proofOfResidency'      => 'proof_of_residency',
    ];

    foreach ($files as $inputName => $dbColumn) {
        if ($request->hasFile($inputName)) {
            $data[$dbColumn] = $request->file($inputName)->store('admissions/documents', 'public');
        }
    }

    Admission::create($data);

    return redirect()->back()->with('status', 'submitted')->with('appId', $applicationId);
}
}