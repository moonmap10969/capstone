<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\Schedule;
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
            'pending_requests'  => Enrollment::where('status', 'pending')->count(),
            'new_this_week'     => Enrollment::where('created_at', '>=', now()->startOfWeek())->count(),
        ];

        return view('registrar.enrollment.index', compact('sections', 'stats', 'enrollments', 'approvedAdmissions'));
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
    // 1. Fetch the preset fees for the student's specific grade level
    $preset = FeeStructure::where('year_level', $request->grade_level)->first();

    if (!$preset) {
        return back()->with('error', "Fee structure for {$request->grade_level} not found. Please set it up first.");
    }

    // 2. Pass the preset data into the calculation logic
    $data = $this->calculateFlexibleFees($request, $preset);
    
    Tuition::create($data);
    return back()->with('success', 'Assessment generated based on grade-level presets.');
}

private function calculateFlexibleFees(Request $request, $preset)
{
    $baseTuition = $preset->base_tuition;
    $totalMisc = $preset->total_misc;
    $discountRate = 0;

    // Apply Grade 7 Discount (30%) if applicable
    if ($request->grade_level === 'Grade 7') {
        $discountRate += 0.30;
    }

    // UMC & Sibling Logic
    if ($request->umc_affiliation === 'worker') {
        $discountRate = 1.0; 
    } elseif ($request->umc_affiliation === 'member') {
        $discountRate = 0.5;
    } else {
        $siblingTiers = ['none' => 0, '2nd' => 0.10, '3rd' => 0.20, '4th' => 0.30];
        $discountRate += $siblingTiers[$request->sibling_order] ?? 0;
    }

    // Math: Apply Tuition Discount then Early Payment Discount
    $netTuition = $baseTuition * (1 - min($discountRate, 1));
    $earlyRate = ['full' => 0.10, 'quarterly' => 0.05][$request->payment_schedule] ?? 0;
    $finalTuition = $netTuition * (1 - $earlyRate);

    return [
        'studentNumber' => $request->studentNumber,
        'name' => $request->name,
        'grade_level' => $request->grade_level,
        'tuition_fee' => $finalTuition,
        'misc_fees' => $totalMisc,
        'amount' => $finalTuition + $totalMisc,
        'balance' => $finalTuition + $totalMisc,
        'payment_schedule' => $request->payment_schedule,
        'status' => 'pending'
    ];
}
}