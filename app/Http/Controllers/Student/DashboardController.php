<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Example data - replace with actual data from your models
        $grades = [
            ['subject' => 'Math 101', 'score' => 'A'],
            ['subject' => 'English 101', 'score' => 'B+'],
            ['subject' => 'Science 101', 'score' => 'A-'],
        ];

        $upcomingClasses = [
            ['subject' => 'Physics', 'room' => '204', 'time' => '8:00 AM'],
            ['subject' => 'Chemistry', 'room' => '305', 'time' => '10:00 AM'],
        ];

        $announcements = [
            ['title' => 'Assignment Deadline', 'type' => 'deadline', 'date' => 'Jan 20, 2026'],
            ['title' => 'New Lecture Uploaded', 'type' => 'info', 'date' => 'Jan 17, 2026'],
        ];

        $studentGPA = '3.72';
        $gpaTrend = '+0.15 from last sem';
        $enrolledUnits = 20;
        $maxUnits = 21;
        $completedCourses = 42;
        $remainingCourses = 8;
        $attendance = '96%';
        $semester = 'Spring 2026';
        $enrollmentStatus = 'Officially Enrolled';

        return view('student.dashboard', compact(
            'grades',
            'upcomingClasses',
            'announcements',
            'studentGPA',
            'gpaTrend',
            'enrolledUnits',
            'maxUnits',
            'completedCourses',
            'remainingCourses',
            'attendance',
            'semester',
            'enrollmentStatus'
        ));
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

    return view('student.admissions', compact('currentInfo', 'progress', 'admissionSteps'));
}


}
