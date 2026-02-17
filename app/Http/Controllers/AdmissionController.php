<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admission;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationSubmitted;

class AdmissionController extends Controller
{
    public function index()
    {
        if (Auth::guest()) {
            return view('admissions');
        }
        
        $user = Auth::user();
        $admission = $user->admissions()->latest()->first();

        if ($admission) {
            return view('success-card');
        }

        return view('admissions');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'studentFirstName' => 'required|string|max:255',
            'studentLastName'  => 'required|string|max:255',
            'dateOfBirth'      => 'required|date',
            'year_level'       => 'required|string',
            'parentFirstName'  => 'required|string|max:255',
            'parentLastName'   => 'required|string|max:255',
            'email'            => 'required|email',
            'phone'            => 'required|string',
            'address'          => 'required|string',
            'city'             => 'required|string',
            'state'            => 'required|string',
            'zipCode'          => 'required|string',
            'report_card'      => 'required|image|max:2048',
            'birth_certificate'=> 'required|image|max:2048',
            'applicant_photo'  => 'required|image|max:2048',
            'father_photo'     => 'required|image|max:2048',
            'mother_photo'     => 'required|image|max:2048',
            'guardian_photo'   => 'required|image|max:2048',
        ]);

        $fileFields = ['report_card', 'birth_certificate', 'applicant_photo', 'father_photo', 'mother_photo', 'guardian_photo'];
        
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $validatedData[$field] = $request->file($field)->store('admissions/documents', 'public');
            }
        }

        // Fix: Explicitly included validated parent data into the creation array
        $admission = Admission::create(array_merge($validatedData, [
            'user_id' => Auth::id(),
            'status'  => 'pending',
            'studentNumber' => 'PENDING-' . time(),
            'parentFirstName' => $validatedData['parentFirstName'],
            'parentLastName' => $validatedData['parentLastName'],
            'street'  => $request->address, 
            'zip'     => $request->zipCode, 
        ]));

        foreach ($fileFields as $field) {
            if (isset($validatedData[$field])) {
                Document::create([
                    'user_id'   => Auth::id(),
                    'file_name' => ucwords(str_replace('_', ' ', $field)),
                    'file_path' => $validatedData[$field],
                    'type'      => 'admission_record',
                    'status'    => 'Pending'
                ]);
            }
        }

        Mail::to($request->email)->send(new ApplicationSubmitted($admission));

        return view('success-card');
    }
}