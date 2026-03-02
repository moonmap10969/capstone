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
    // 1. Validate the basic requirements
    $request->validate([
        'admission_ids' => 'required|array',
        'section_id' => 'required|exists:sections,section_id',
        'shift' => 'required',
    ]);

    $activeYear = AcademicYear::where('is_current', true)->first();
    $section = Section::find($request->section_id);

    // In EnrollmentController@store
foreach ($request->admission_ids as $id) {
    $admission = Admission::find($id);
    
    $enrollment = Enrollment::create([
        'studentNumber' => $admission->studentNumber,
        'section_id'    => $request->section_id,
        'shift'         => $request->shift,
        'year_level'    => $request->grade_level, // Use form input
        'school_year'   => $request->school_year,
        'status'        => 'enrolled'
    ]);
    
    // Fetch preset based on form's grade_level
    $preset = FeeStructure::where('year_level', $request->grade_level)
        ->where('academic_year_id', $activeYear->id)
        ->first();
    
        // 3. Update Admission status so they don't show up in the list anymore
        $admission->update(['status' => 'enrolled']);

        // 4. Generate Tuition Assessment
        $preset = FeeStructure::where('year_level', $admission->year_level)
            ->where('academic_year_id', $activeYear->id)
            ->first();

        if ($preset) {
            $tuitionData = $this->calculateFlexibleFees($admission, $enrollment, $preset, $request);
            Tuition::create($tuitionData);
        }
    }

    return redirect()->route('registrar.enrollment.index')->with('success', 'Students enrolled and assessments generated.');
}

private function calculateFlexibleFees($admission, $enrollment, $preset, $request)
{
    $baseTuition = (float) $preset->base_tuition;
    $totalMisc = (float) $preset->total_misc;
    $discountRate = 0;

    // Apply Grade 7 Discount (30%)
    if ($admission->year_level === 'Grade 7') { $discountRate += 0.30; }

    // Use default values since these aren't in your current form
    $paymentSchedule = 'monthly'; 
    
    $netTuition = $baseTuition * (1 - min($discountRate, 1));
    
    return [
        'enrollment_id'    => $enrollment->id, // Critical link
        'studentNumber'    => $admission->studentNumber,
        'academic_year_id' => $preset->academic_year_id, 
        'name'             => "{$admission->studentFirstName} {$admission->studentLastName}",
        'grade_level'      => $admission->year_level,
        'tuition_fee'      => $netTuition,
        'misc_fees'        => $totalMisc,
        'amount'           => $netTuition + $totalMisc,
        'balance'          => $netTuition + $totalMisc,
        'payment_schedule' => $paymentSchedule,
        'status'           => 'pending'
    ];
}


}