<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware; // Add this
use Illuminate\Routing\Controllers\Middleware;

class AdmissionController extends Controller
{


public function index()
{
    if (Auth::guest()) {
        return view('admissions'); // Your public landing page with the "Register" card
    }
    
    /** @var \App\Models\User $user */
    $user = Auth::user();

    // Only attempt to fetch admissions if a user is actually logged in
    $admission = $user ? $user->admissions()->latest()->first() : null;

    $currentStep = match($admission?->status) {
        'pending'   => 2,
        'reviewing' => 3,
        'approved'  => 4,
        default     => 1,
    };

    return view('student.admissions.index', compact('currentStep'));
}

    public function create()
    {
        return view('student.admissions.create');
    }


    public function store(Request $request)
    {
        // 1. Validate all inputs
        $validatedData = $request->validate([
            'studentFirstName' => 'required|string|max:255',
            'studentLastName'  => 'required|string|max:255',
            'dateOfBirth'      => 'required|date',
            'year_level'       => 'required|string',
            'previousSchool'   => 'nullable|string',
            'parentFirstName'  => 'required|string',
            'parentLastName'   => 'required|string',
            'email'            => 'required|email',
            'phone'            => 'required|string',
            'address'          => 'required|string',
            'city'             => 'required|string',
            'state'            => 'required|string',
            'zipCode'          => 'required|string',
            'report_card'      => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'birth_certificate'=> 'required|image|mimes:jpg,png,jpeg|max:2048',
            'applicant_photo'  => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'father_photo'     => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'mother_photo'     => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'guardian_photo'   => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'transferee_docs'  => 'nullable|file|mimes:pdf,jpg,png|max:5120',
        ]);

        // 2. Process File Uploads
        $fileFields = ['report_card', 'birth_certificate', 'applicant_photo', 'father_photo', 'mother_photo', 'guardian_photo', 'transferee_docs'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $validatedData[$field] = $request->file($field)->store('admissions/documents', 'public');
            }
        }

            // 3. Create Admission Record
        $admission = Admission::create(array_merge($validatedData, [
            'user_id' => Auth::id(),
            'status'  => 'pending',
            'street'  => $request->address, 
            'zip'     => $request->zipCode, 
        ]));

        // 4. Sync to Documents Table
        foreach ($fileFields as $field) {
            if (isset($validatedData[$field])) {
                \App\Models\Document::create([
                    'user_id'   => Auth::id(),
                    'file_name' => ucwords(str_replace('_', ' ', $field)),
                    'file_path' => $validatedData[$field],
                    'type'      => 'admission_record',
                    'status'    => 'Pending' // Initial status before admin approval
                ]);
            }
        }

        return view('success-card');
    }
}