<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // Correct Facade import

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Or use the helper: auth()->user();
        
        $stats = [
            ['label' => 'Current GPA', 'value' => '1.75', 'color' => 'text-green-600'],
            ['label' => 'Attendance', 'value' => '95%', 'color' => 'text-green-600'],
            ['label' => 'Balance Due', 'value' => '₱12,500', 'color' => 'text-green-600'],
        ];

        $announcements = [
            [
                'title' => 'First Quarter Exams',
                'date' => '2026-10-15',
                'display_date' => 'Oct 15-19, 2026',
                'description' => 'Midterm examinations for all grade levels.'
            ]
        ];

        return view('student.dashboard', compact('user', 'stats', 'announcements'));
    }
    
    public function admissions()
{
    $currentInfo = [
        'program' => 'Junior High School',
        'yearLevel' => 'Grade 7',
        'section' => 'A',
        'academicYear' => '2025-2026',
        'adviser' => 'Ms. Reyes',
        'status' => 'Active',
    ];

    $progress = 100; // for progress bar
    $admissionSteps = [
        ['title' => 'Application Submitted', 'date' => 'Jan 5, 2026', 'status' => 'completed', 'iconPath' => 'M5 13l4 4L19 7'],
        ['title' => 'Documents Uploaded', 'date' => 'Jan 7, 2026', 'status' => 'completed', 'iconPath' => 'M5 13l4 4L19 7'],
        ['title' => 'Registrar Approval', 'date' => 'Jan 10, 2026', 'status' => 'pending', 'iconPath' => 'M5 13l4 4L19 7'],
    ];

    

    return view('student.dashboard', compact('currentInfo', 'progress', 'admissionSteps'));
}


}