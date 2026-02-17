<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Enrollment;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
public function index()
{
    // Eager load relationships to get student names and section names
    $enrollments = \App\Models\Enrollment::with(['admission'])
        ->latest()
        ->paginate(10);
    
    $sections = \App\Models\Section::all();
    $approvedAdmissions = \App\Models\Admission::where('status', 'approved')->get();
    
    $stats = (object) [
        'total_enrollments' => \App\Models\Enrollment::count(),
        'pending_requests' => \App\Models\Enrollment::where('status', 'pending')->count(),
        'new_this_week' => \App\Models\Enrollment::where('created_at', '>=', now()->startOfWeek())->count(),
    ];

    return view('registrar.enrollment.index', compact('sections', 'stats', 'enrollments', 'approvedAdmissions'));
}
public function create()
{
    $approvedAdmissions = \App\Models\Admission::where('status', 'approved')->get();
    // Added 'id' to selection to ensure the form can pass a valid section_id to the database
    $sections = \App\Models\Section::select( 'name', 'year_level')->get();

    return view('registrar.enrollment.create', compact('approvedAdmissions', 'sections'));
}
public function store(Request $request)
{
    $request->validate([
        'admission_ids' => 'required',
        'section_id'    => 'required|exists:sections,section_id', // Validates that the ID exists
        'shift'         => 'required|string',
        'school_year'   => 'required|string',
    ]);

    $admissionIds = json_decode($request->admission_ids);

    foreach ($admissionIds as $id) {
        $admission = \App\Models\Admission::find($id);
        
        if ($admission) {
            \App\Models\Enrollment::create([
                'studentNumber' => $admission->studentNumber,
                'section_id'    => $request->section_id, // Now receiving a numeric ID
                'shift'         => $request->shift,
                'year_level'    => $admission->year_level,
                'school_year'   => $request->school_year,
                'status'        => 'enrolled',
            ]);

            // Mark admission as enrolled so it disappears from selection
            $admission->update(['status' => 'enrolled']);
        }
    }

    return redirect()->route('registrar.enrollment.index')->with('success', 'Enrollment successful!');
}
}