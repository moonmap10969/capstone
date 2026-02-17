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
    $teacher = $request->query('teacher', 'All Teachers'); // Add this line

    $schedules = Schedule::query()
        ->when($day !== 'All Days', fn($q) => $q->where('day_of_week', $day))
        ->when($grade !== 'All Grades', fn($q) => $q->where('year_level', $grade))
        ->when($teacher !== 'All Teachers', fn($q) => $q->where('teacher', $teacher)) // Add this line
        ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')")
        ->orderBy('start_time')
        ->get();

    // Fetch unique teacher names to populate the dropdown
    $teachers = Schedule::distinct()->pluck('teacher'); 

    return view('admin.schedule.index', compact('schedules', 'day', 'grade', 'teacher', 'teachers'));
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

    $conflict = Schedule::where('day_of_week', $request->day_of_week)
        ->where(function ($query) use ($request) {
            $query->where('teacher', $request->teacher)
                  ->orWhere('room', $request->room);
        })
        ->where(function ($query) use ($request) {
            $query->where('start_time', '<', $request->end_time)
                  ->where('end_time', '>', $request->start_time);
        })->first();

if ($conflict) {
    return redirect()->route('admin.schedule.index') // Change this
        ->with('conflict', true)
        ->with('conflict_id', $conflict->id)
        ->with('conflict_message', "Conflict: Teacher {$request->teacher} is already assigned to {$conflict->subject} at this time.")
        ->withInput();
}

    Schedule::create($validated);
    return redirect()->route('admin.schedule.index')->with('success', 'Schedule added successfully.');
}

public function update(Request $request, Schedule $schedule)
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

    $conflict = Schedule::where('id', '!=', $schedule->id)
        ->where('day_of_week', $request->day_of_week)
        ->where(function ($query) use ($request) {
            $query->where('teacher', $request->teacher)
                  ->orWhere('room', $request->room);
        })
        ->where(function ($query) use ($request) {
            $query->where('start_time', '<', $request->end_time)
                  ->where('end_time', '>', $request->start_time);
        })->first();

if ($conflict) {
    return redirect()->back()
        ->with('conflict_popup', [
            'teacher' => $conflict->teacher,
            'subject' => $conflict->subject,
            'room'    => $conflict->room,
            'time'    => $conflict->start_time . ' - ' . $conflict->end_time,
        ])
        ->withInput();
}

    $schedule->update($validated);
    return redirect()->route('admin.schedule.index')->with('success', 'Schedule updated successfully.');
}

public function destroy(Schedule $schedule)
{
    $schedule->delete();
    return redirect()->route('admin.schedule.index')->with('success', 'Schedule deleted successfully.');
}
}