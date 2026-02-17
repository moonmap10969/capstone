<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Enrollment;
use App\Models\Section;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['admission', 'section'])->latest()->paginate(10);
        $sections = Section::withCount('enrollments')->get();
        $approvedAdmissions = Admission::where('status', 'approved')->get();
        
        $stats = (object) [
            'total_enrollments' => Enrollment::count(),
            'pending_requests' => Enrollment::where('status', 'pending')->count(),
            'new_this_week' => Enrollment::where('created_at', '>=', now()->startOfWeek())->count(),
        ];

        return view('registrar.enrollment.index', compact('sections', 'stats', 'enrollments', 'approvedAdmissions'));
    }

    public function create()
    {
        $approvedAdmissions = Admission::where('status', 'approved')->get();
        // Fixed: Fetching capacity and enrollment counts so the frontend can identify full sections
        $sections = Section::withCount('enrollments')->get();

        return view('registrar.enrollment.create', compact('approvedAdmissions', 'sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'admission_ids' => 'required',
            'section_id'    => 'required|exists:sections,section_id',
            'shift'         => 'required|string',
            'school_year'   => 'required|string',
        ]);

        $section = Section::withCount('enrollments')->findOrFail($request->section_id);
        $admissionIds = json_decode($request->admission_ids);

        // Security Check: Ensure the section doesn't exceed capacity during the save process
        if (($section->enrollments_count + count($admissionIds)) > ($section->capacity ?? 40)) {
            return back()->with('error', 'Action failed: This section has reached its maximum capacity.');
        }

        foreach ($admissionIds as $id) {
            $admission = Admission::find($id);
            if ($admission) {
                Enrollment::create([
                    'studentNumber' => $admission->studentNumber,
                    'section_id'    => $request->section_id,
                    'shift'         => $request->shift,
                    'year_level'    => $admission->year_level,
                    'school_year'   => $request->school_year,
                    'status'        => 'enrolled',
                ]);
                $admission->update(['status' => 'enrolled']);
            }
        }

        return redirect()->route('registrar.enrollment.index')->with('success', 'Enrollment successful!');
    }
}