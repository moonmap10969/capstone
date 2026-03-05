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
use App\Mail\EnrollmentReminder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Process;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->get('academic_year');
        $academicYears = AcademicYear::orderBy('year_range', 'desc')->get();
        
        // 1. Retention Logic
        $currentYear = AcademicYear::where('is_current', true)->first();
        $previousYear = AcademicYear::where('id', '<', $currentYear->id)
                                    ->orderBy('id', 'desc')->first();

        $atRiskStudents = collect();
        if ($previousYear && $currentYear) {
            $previousStudentNums = Enrollment::whereHas('admission', fn($q) => $q->where('academic_year_id', $previousYear->id))
                ->pluck('studentNumber');

            $currentStudentNums = Enrollment::whereHas('admission', fn($q) => $q->where('academic_year_id', $currentYear->id))
                ->pluck('studentNumber');

            $atRiskStudentNumbers = $previousStudentNums->diff($currentStudentNums);
            $atRiskStudents = Admission::whereIn('studentNumber', $atRiskStudentNumbers)->get();
        }
        
        // 2. Stats
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

        return view('registrar.enrollment.index', compact('enrollments', 'stats', 'academicYears', 'atRiskStudents', 'currentYear'));
    }

public function create(Request $request)
{
    $approvedAdmissions = Admission::where('status', 'approved')->get()->map(function($student) {
        
        // 1. Calculate Outstanding Balance
        $student->balance = Tuition::where('studentNumber', $student->studentNumber)->sum('balance');
        
        // 2. Distinguish New vs. Returning Students dynamically
        // If the student number exists in the enrollments table, they have been here before.
        $hasPastEnrollment = Enrollment::where('studentNumber', $student->studentNumber)->exists();
        $student->student_type = $hasPastEnrollment ? 'returning' : 'new';
        
        return $student;
    });

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
            'year_level' => 'required', 
            'shift' => 'required',
        ]);

        $activeYear = AcademicYear::where('is_current', true)->first();

        // Backend Security: Double-check balances before saving
        foreach ($request->admission_ids as $id) {
            $admission = Admission::find($id);
            $balance = Tuition::where('studentNumber', $admission->studentNumber)->sum('balance');
            
            if ($balance > 0) {
                return redirect()->back()->with('error', "Cannot enroll {$admission->studentFirstName}. Outstanding balance: ₱" . number_format($balance, 2));
            }
        }

        // Process Enrollment
        foreach ($request->admission_ids as $id) {
            $admission = Admission::find($id);
            
            $enrollment = Enrollment::create([
                'studentNumber' => $admission->studentNumber,
                'academic_year_id' => $activeYear->id,
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

    public function retentionAnalytics()
    {
        $currentYear = AcademicYear::where('is_current', true)->first();
        if (!$currentYear) {
            return redirect()->back()->with('error', 'Please set a current Academic Year first.');
        }

        $previousYear = AcademicYear::where('id', '!=', $currentYear->id)
                                    ->orderBy('year_range', 'desc')
                                    ->first();

        if (!$previousYear) {
            $atRiskStudents = collect();
            return view('registrar.retention', compact('atRiskStudents', 'currentYear'))
                   ->with('info', 'First year of operation: No previous data for retention analysis.');
        }

        $previousStudentNums = Enrollment::where('academic_year_id', $previousYear->id)->pluck('studentNumber');
        $currentStudentNums = Enrollment::where('academic_year_id', $currentYear->id)->pluck('studentNumber');
        $atRiskStudentNumbers = $previousStudentNums->diff($currentStudentNums);

        $atRiskStudents = Admission::whereIn('studentNumber', $atRiskStudentNumbers)
            ->where('academic_year_id', $previousYear->id)
            ->get();

        return view('registrar.enrollment.retention', compact('atRiskStudents', 'currentYear'));
    }

    public function sendBurstAlerts(Request $request)
    {
        $currentYear = AcademicYear::where('is_current', true)->first();
        $previousYear = AcademicYear::where('id', '!=', $currentYear->id)->orderBy('year_range', 'desc')->first();

        $previousNums = Enrollment::where('academic_year_id', $previousYear->id)->pluck('studentNumber');
        $currentNums = Enrollment::where('academic_year_id', $currentYear->id)->pluck('studentNumber');
        $atRiskNums = $previousNums->diff($currentNums);

        $students = Admission::whereIn('studentNumber', $atRiskNums)
            ->where('academic_year_id', $previousYear->id)->get();

        foreach ($students as $student) {
            if ($student->email) {
                $message = str_replace('[Student Name]', $student->studentFirstName, $request->custom_message);
                
                Mail::to($student->email)->send(new EnrollmentReminder($student->studentFirstName, $message));

                // Updated to use the new email_logs table
                DB::table('email_logs')->insert([
                    'studentNumber' => $student->studentNumber,
                    'recipient_email' => $student->email, 
                    'subject' => 'Action Required: Enrollment for SY ' . $currentYear->year_range,
                    'message' => $message,
                    'status' => 'sent',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        return redirect()->back()->with('success', 'Email reminders sent and logged successfully.');
    }
private function mapYearLevelToNumeric($yearLevel)
{
    $levels = [
        'kinder1' => 1, 'kinder2' => 2, 'kinder3' => 3,
        'grade1' => 4, 'grade2' => 5, 'grade3' => 6, 'grade4' => 7,
        'grade5' => 8, 'grade6' => 9, 'grade7' => 10, 'grade8' => 11,
        'grade9' => 12, 'grade10' => 13,
    ];

    return $levels[strtolower($yearLevel)] ?? 0;
}
    public function getPredictiveAtRiskQueue()
{
    $students = Admission::where('status', 'enrolled')->get();
    
    // Prepare features for the Python script
    $features = $students->map(function($s) {
        return [
            $s->tuition->balance ?? 0,
            $s->grades()->avg('grade') ?? 85,
            $this->mapYearLevelToNumeric($s->year_level),
            $s->sibling_order === 'none' ? 0 : 1
        ];
    });

    // Execute the Python script
    $result = Process::run(['python3', base_path('scripts/student_risk_model.py'), json_encode($features)]);
    
    $riskScores = json_decode($result->output());

    // Filter students with a Risk Score higher than 70%
    return $students->filter(function($s, $index) use ($riskScores) {
        return $riskScores[$index] > 0.70;
    });
}
}