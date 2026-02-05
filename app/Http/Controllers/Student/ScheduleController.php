<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use App\Models\Schedule;

class ScheduleController extends Controller
{
public function index()
{
    $student = Auth::user(); 
    $schedules = \App\Models\Schedule::where('year_level', $student->year_level) 
        ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')")
        ->orderBy('start_time')
        ->get();

    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    $weeklySchedule = collect($days)->map(fn($day) => [
        'day' => $day,
        'subjects' => $schedules->where('day_of_week', $day)
    ]);

    $subjects = $schedules->unique('subject')->map(fn($item) => [
        'name' => $item->subject,
        'units' => $item->units ?? 3, // Fallback value so the view doesn't crash
        'description' => $item->description ?? 'No description available',
        'teacher' => $item->teacher ?? 'TBA',
        'schedule' => \Carbon\Carbon::parse($item->start_time)->format('g:i A') . ' - ' . \Carbon\Carbon::parse($item->end_time)->format('g:i A'),
        'room' => $item->room ?? 'TBA'
    ]);

    return view('student.schedule.index', [
        'weeklySchedule' => $weeklySchedule,
        'subjects' => $subjects,
        'totalUnits' => $subjects->sum('units')
    ]);
}
    public function dashboard() {
        $user = Auth::user();
        
        $stats = [
            ['label' => 'Current GPA', 'value' => '1.75', 'icon' => 'trending-up', 'color' => 'text-green-500'],
            ['label' => 'Attendance', 'value' => '95%', 'icon' => 'calendar', 'color' => 'text-green-500'],
            ['label' => 'Balance Due', 'value' => '₱12,500', 'icon' => 'credit-card', 'color' => 'text-green-500'],
        ];

        $announcements = [
            [
                'title' => 'First Quarter Exams',
                'display_date' => 'Oct 15-19, 2026',
                'description' => 'Midterm examinations for all grade levels.'
            ]
        ];

        return view('student.dashboard', compact('user', 'stats', 'announcements'));
    }
}