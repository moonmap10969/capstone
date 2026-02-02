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
        $admissions = Admission::where('user_id', Auth::id())->latest()->paginate(10);
        return view('student.admissions.index', compact('admissions'));
    }

    public function create()
    {
        return view('student.admissions.create');
    }

    public function store(Request $request)
    {
        // 1. Validate all inputs including files
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

        // 3. Save to Database
        Admission::create(array_merge($validatedData, [
            'user_id' => Auth::id(),
            'status'  => 'pending',
            'street'  => $request->address, 
            'zip'     => $request->zipCode, 
        ]));

        return view('success-card');
    }
}