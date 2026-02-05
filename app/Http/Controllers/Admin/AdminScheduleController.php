<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AdminScheduleController extends Controller
{
public function index(Request $request)
{
    $day = $request->query('day', 'All Days');
    $grade = $request->query('grade', 'All Grades');

    $schedules = Schedule::query()
        ->when($day !== 'All Days', fn($q) => $q->where('day_of_week', $day))
        ->when($grade !== 'All Grades', fn($q) => $q->where('year_level', $grade))
        ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')")
        ->orderBy('start_time')
        ->get();

    return view('admin.schedule.index', compact('schedules', 'day', 'grade'));
}
public function create()
{
    // Make sure this view file exists at resources/views/admin/schedule/create.blade.php
    return view('admin.schedule.create');
}

public function edit(Schedule $schedule)
{
    // Make sure this view file exists at resources/views/admin/schedule/edit.blade.php
    return view('admin.schedule.edit', compact('schedule'));
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'teacher' => 'required|string|max:255',
            'day_of_week' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'required|string|max:255',
            'year_level' => 'required|string',
            'section' => 'required|string|max:255',
        ]);

        Schedule::create($validated);
        return redirect()->route('admin.schedule.index')->with('success', 'Schedule added successfully.');
    }
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'teacher' => 'required|string|max:255',
            'day_of_week' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'required|string|max:255',
            'year_level' => 'required|integer',
            'section' => 'required|string|max:5',
        ]);

        $schedule->update($request->all());
        return redirect()->route('admin.schedule.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedule.index')->with('success', 'Schedule deleted successfully.');
    }
}
