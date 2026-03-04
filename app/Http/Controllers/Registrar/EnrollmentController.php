<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\FeeStructure; 
use App\Models\Tuition;    
use App\Models\AcademicYear;

class EnrollmentController extends Controller
{
public function index(Request $request)
{
    $selectedYear = $request->get('academic_year');
    $academicYears = \App\Models\AcademicYear::orderBy('year_range', 'desc')->get();
    
    // Fetch stats based on selected year (or all if none selected)
    $stats = (object)[
        'total_enrollments' => Enrollment::when($selectedYear, fn($q) => $q->whereHas('admission', fn($a) => $a->where('academic_year_id', $selectedYear)))->count(),
        'pending_requests' => Enrollment::where('status', 'pending')->when($selectedYear, fn($q) => $q->whereHas('admission', fn($a) => $a->where('academic_year_id', $selectedYear)))->count(),
        'new_this_week' => Enrollment::where('created_at', '>=', now()->startOfWeek())->count(),
    ];

    $enrollments = Enrollment::with(['admission.academicYear', 'section'])
        ->when($selectedYear, function($query) use ($selectedYear) {
            return $query->whereHas('admission', function($q) use ($selectedYear) {
                $q->where('academic_year_id', $selectedYear);
            });
        })
        ->latest()
        ->paginate(15)
        ->appends($request->all());

    return view('registrar.enrollment.index', compact('enrollments', 'stats', 'academicYears'));
}

    public function create(Request $request)
    {
        $approvedAdmissions = Admission::where('status', 'approved')->get();
        $type = $request->query('type', 'new');
        $sections = Section::withCount('enrollments')->get();
        $schedules = Schedule::all(); 

        return view('registrar.enrollment.create', compact('approvedAdmissions', 'sections', 'schedules'));
    }

   public function store(Request $request)
{
    $request->validate([
        'admission_ids' => 'required|array',
        'section_id' => 'required|exists:sections,section_id',
        'year_level' => 'required', // Consistent naming
        'shift' => 'required',
    ]);

    $activeYear = AcademicYear::where('is_current', true)->first();

    foreach ($request->admission_ids as $id) {
        $admission = Admission::find($id);
        
        $enrollment = Enrollment::create([
            'studentNumber' => $admission->studentNumber,
            'section_id'    => $request->section_id,
            'shift'         => $request->shift,
            'year_level'    => $request->year_level, 
            'school_year'   => $request->school_year,
            'status'        => 'enrolled'
        ]);

        $preset = FeeStructure::where('year_level', $request->year_level)
            ->where('academic_year_id', $activeYear->id)
            ->first();

        if ($preset) {
            // Pass the data consistently
            $tuitionData = $this->calculateFlexibleFees($admission, $enrollment, $preset);
            Tuition::create($tuitionData);
        }

        $admission->update(['status' => 'enrolled']);
    }

    return redirect()->route('registrar.enrollment.index')->with('success', 'Students enrolled successfully.');
}

private function calculateFlexibleFees($admission, $enrollment, $preset)
{
    $baseTuition = (float) $preset->base_tuition;
    $totalMisc = (float) $preset->total_misc;
    
    return [
        'enrollment_id'    => $enrollment->id,
        'studentNumber'    => $admission->studentNumber,
        'academic_year_id' => $preset->academic_year_id, 
        'name'             => "{$admission->studentFirstName} {$admission->studentLastName}",
        'year_level'       => $enrollment->year_level, 
        'tuition_fee'      => $baseTuition,
        'misc_fees'        => $totalMisc,
        'amount'           => $baseTuition + $totalMisc,
        'balance'          => $baseTuition + $totalMisc,
        'payment_schedule' => 'monthly',
        'status'           => 'pending'
    ];
}


}