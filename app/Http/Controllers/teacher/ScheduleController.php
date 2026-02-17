<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth; // 1. Add this import at the top

class ScheduleController extends Controller
{
    public function index()
    {
        // 2. Use Auth::user()->name instead of the helper
        $schedules = Schedule::where('teacher', Auth::user()->name) 
            ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')")
            ->orderBy('start_time')
            ->get();

        return view('teacher.schedule.index', compact('schedules'));
    }
}