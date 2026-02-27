<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\{
    Schedule,
    Attendance,
    Section,
    GradingComponent,
    Enrollment,
    ClassRecord,
    GradingItem,
    StudentGrade
};

class GradeController extends Controller
{

    /**
     * Display summarized class record and attendance
     */
    public function index(Request $request)
    {
        $teacherName = Auth::user()->name;
        $date = $request->query('date', date('Y-m-d'));

        // 1️⃣ Get Teacher Sections
        $assignedSchedules = Schedule::where('teacher', $teacherName)
            ->select('section', 'year_level')
            ->distinct()
            ->get();

        $sections = $assignedSchedules->map(function ($item) {
            return Section::where('name', trim($item->section))
                ->where('year_level', trim($item->year_level))
                ->first();
        })->filter();

        $selectedSectionId = $request->query(
            'section',
            $sections->first()->section_id ?? null
        );

        if (!$selectedSectionId) {
            return view('teacher.grades.index', compact('sections', 'date'));
        }

        // 2️⃣ Run Auto Grade Computation
        $this->runGradeComputation($selectedSectionId);

        // 3️⃣ Fetch Components & Items
        $components = GradingComponent::where('section_id', $selectedSectionId)->get();

        $gradingItems = GradingItem::where('section_id', $selectedSectionId)
            ->with('component')
            ->get();

        // 4️⃣ Load Enrollments with ClassRecord
        $enrollments = Enrollment::where('section_id', $selectedSectionId)
            ->with(['admission', 'classRecord'])
            ->get()
            ->map(function ($enrollment) {
                $enrollment->final_percentage =
                    $enrollment->classRecord->final_average ?? 0;
                return $enrollment;
            });

        // 5️⃣ Dashboard Statistics
        $totalStudents = $enrollments->count();
        $classAverage = $totalStudents > 0 ? $enrollments->avg('final_percentage') : 0;
        $passingRate = $totalStudents > 0
            ? ($enrollments->where('final_percentage', '>=', 75)->count() / $totalStudents) * 100
            : 0;
        $highestGrade = $enrollments->max('final_percentage') ?? 0;

        // 6️⃣ Attendance Data
        $attendanceRecords = Attendance::where('section_id', $selectedSectionId)
            ->whereDate('date', $date)
            ->pluck('status', 'studentNumber')
            ->toArray();

        $attendanceDates = Attendance::where('section_id', $selectedSectionId)
            ->select('date')
            ->distinct()
            ->orderBy('date', 'desc')
            ->pluck('date');

        return view('teacher.grades.index', compact(
            'sections',
            'components',
            'gradingItems',
            'enrollments',
            'selectedSectionId',
            'attendanceRecords',
            'attendanceDates',
            'date',
            'classAverage',
            'passingRate',
            'highestGrade'
        ));
    }

    /**
     * CORE GRADE COMPUTATION
     */
    private function runGradeComputation($sectionId)
    {
        $categories = GradingComponent::where('section_id', $sectionId)->get();
        $students = Enrollment::where('section_id', $sectionId)->get();

        foreach ($students as $student) {

            $finalGrade = 0;

            foreach ($categories as $category) {

                $categoryScore = 0;

                // 🔵 ATTENDANCE CATEGORY
                if (stripos($category->category, 'attendance') !== false) {

                    $totalDays = Attendance::where('section_id', $sectionId)
                        ->distinct('date')
                        ->count('date');

                    $presentDays = Attendance::where('studentNumber', $student->studentNumber)
                        ->where('section_id', $sectionId)
                        ->where('status', 'Present')
                        ->count();

                    $categoryScore = $totalDays > 0
                        ? ($presentDays / $totalDays)
                        : 0;

                } else {

                    // 🔵 NORMAL GRADE CATEGORY
                    $itemIds = GradingItem::where('component_id', $category->id)
                        ->pluck('id');

                    if ($itemIds->isEmpty()) {
                        continue;
                    }

                    $studentGrades = StudentGrade::where('enrollment_id', $student->id)
                        ->whereIn('grading_item_id', $itemIds)
                        ->get();

                    $totalEarned = $studentGrades->sum('raw_score');

                    $totalMax = GradingItem::whereIn('id', $itemIds)
                        ->sum('max_score');

                    $categoryScore = $totalMax > 0
                        ? ($totalEarned / $totalMax)
                        : 0;
                }

                // 🔵 Apply Weight
                $finalGrade += $categoryScore * ($category->percentage / 100);
            }

            // ✅ IMPORTANT FIX:
            // class_records.studentNumber references enrollments.id
            ClassRecord::updateOrCreate(
                [
                    'studentNumber' => $student->id, // MUST match enrollments.id
                    'section_id' => $sectionId
                ],
                [
                    'final_average' => min($finalGrade * 100, 100)
                ]
            );
        }
    }

    /**
     * Store Attendance
     */
    public function storeAttendance(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,section_id',
            'date' => 'required|date',
            'attendance' => 'required|array'
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->attendance as $studentNumber => $status) {
                Attendance::updateOrCreate(
                    [
                        'section_id' => $request->section_id,
                        'studentNumber' => $studentNumber,
                        'date' => $request->date
                    ],
                    [
                        'status' => $status
                    ]
                );
            }
        });

        return redirect()->to(route('teacher.grades.index', [
            'section' => $request->section_id,
            'date' => $request->date
        ]) . '#attendance')
            ->with('success', 'Attendance updated!');
    }

    /**
     * Store Scores
     */
    public function storeScores(Request $request)
    {
        $request->validate([
            'grading_item_id' => 'required|exists:grading_items,id',
            'scores' => 'required|array'
        ]);

        foreach ($request->scores as $enrollmentId => $rawScore) {

            if ($rawScore !== null && $rawScore !== '') {

                StudentGrade::updateOrCreate(
                    [
                        'enrollment_id' => $enrollmentId,
                        'grading_item_id' => $request->grading_item_id
                    ],
                    [
                        'raw_score' => $rawScore
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Scores recorded!');
    }

    /**
     * Store Grading Category
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'percentage' => 'required|numeric|min:1|max:100',
            'section_id' => 'required|exists:sections,section_id'
        ]);

        $currentTotal = GradingComponent::where('section_id', $request->section_id)
            ->where('category', '!=', $request->category)
            ->sum('percentage');

        if (($currentTotal + $request->percentage) > 100) {
            return redirect()->back()
                ->with('error', 'Limit exceeded! Total weight cannot surpass 100%.');
        }

        $words = explode(' ', $request->category);

        $code = count($words) > 1
            ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
            : strtoupper(substr($request->category, 0, 2));

        GradingComponent::updateOrCreate(
            [
                'section_id' => $request->section_id,
                'category' => $request->category
            ],
            [
                'code' => $code,
                'percentage' => $request->percentage,
                'calculation_method' => $request->calculation_method ?? 'average'
            ]
        );

        return redirect()->back()->with('success', 'Grading category saved successfully!');
    }

    /**
     * Store Grading Item
     */
    public function storeItem(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,section_id',
            'component_id' => 'required|exists:grading_components,id',
            'item_name' => 'required|string',
            'max_score' => 'required|numeric|min:1'
        ]);

        GradingItem::create($request->all());

        return redirect()->back()->with('success', 'Activity added!');
    }

    public function destroy($id)
    {
        GradingComponent::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Category deleted!');
    }

    public function destroyItem($id)
    {
        GradingItem::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Activity removed!');
    }
}