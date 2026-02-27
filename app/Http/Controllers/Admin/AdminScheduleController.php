<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\User;    
use App\Models\Section; 
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminScheduleController extends Controller
{
    public function index(Request $request)
    {
        $day = $request->query('day', 'All Days');
        $grade = $request->query('grade', 'All Grades');
        $teacher = $request->query('teacher', 'All Teachers');

        $schedules = Schedule::query()
            ->when($day !== 'All Days', fn($q) => $q->where('day_of_week', $day))
            ->when($grade !== 'All Grades', fn($q) => $q->where('year_level', $grade))
            ->when($teacher !== 'All Teachers', fn($q) => $q->where('teacher', $teacher))
            ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')")
            ->orderBy('start_time')
            ->get();

        $teachers = Schedule::distinct()->pluck('teacher'); 

        return view('admin.schedule.index', compact('schedules', 'day', 'grade', 'teacher', 'teachers'));
    }

    public function create()
    {
        $teachers = User::where('role', 'teacher')->orderBy('name')->get();
        $sections = Section::all();
        return view('admin.schedule.create', compact('teachers', 'sections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string',
            'teacher' => 'required|string',
            'day_of_week' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'required|string',
            'year_level' => 'required|string',
            'section' => 'required|string',
        ]);

        // Find existing section based on UI selection
        $sectionRecord = Section::where('name', $request->section)
            ->where('year_level', $request->year_level)
            ->first();

        if (!$sectionRecord) {
            return back()->withErrors(['section' => 'The selected section does not exist for this grade.'])->withInput();
        }

        // Add the section_id to the array
        $validated['section_id'] = $sectionRecord->id;

        // Generate unique 5-digit custom ID
        do {
            $validated['id'] = random_int(10000, 99999);
        } while (Schedule::where('id', $validated['id'])->exists());

        if ($conflict = $this->checkForConflicts($request)) {
            return $this->handleConflictResponse($conflict, $request);
        }

        Schedule::create($validated);

        return redirect()->route('admin.schedule.index')->with('success', 'Schedule added successfully.');
    }

    public function edit(Schedule $schedule)
    {
        $teachers = User::where('role', 'teacher')->orderBy('name')->get();
        $sections = Section::all();
        return view('admin.schedule.edit', compact('schedule', 'teachers', 'sections'));
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

        // Find existing section based on UI selection
        $sectionRecord = Section::where('name', $request->section)
            ->where('year_level', $request->year_level)
            ->first();

        if (!$sectionRecord) {
            return back()->withErrors(['section' => 'Invalid section selection.'])->withInput();
        }

        $validated['section_id'] = $sectionRecord->id;

        $conflict = $this->checkForConflicts($request, $schedule->id);
        if ($conflict) {
            return $this->handleConflictResponse($conflict, $request);
        }

        $schedule->update($validated);
        return redirect()->route('admin.schedule.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedule.index')->with('success', 'Schedule deleted successfully.');
    }

    private function checkForConflicts($request, $excludeId = null)
    {
        return Schedule::when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->where('day_of_week', $request->day_of_week)
            ->where(function ($query) use ($request) {
                $query->where('teacher', $request->teacher)
                      ->orWhere('room', $request->room);
            })
            ->where(function ($query) use ($request) {
                $query->where('start_time', '<', $request->end_time)
                      ->where('end_time', '>', $request->start_time);
            })->first();
    }

    private function handleConflictResponse($conflict, $request)
    {
        $type = ($conflict->room === $request->room) ? "Room {$request->room}" : "Teacher {$request->teacher}";
        return redirect()->back()
            ->with('conflict_popup', [
                'teacher' => $conflict->teacher,
                'subject' => $conflict->subject,
                'room'    => $conflict->room,
                'time'    => Carbon::parse($conflict->start_time)->format('g:i A') . ' - ' . Carbon::parse($conflict->end_time)->format('g:i A'),
                'message' => "Conflict: {$type} is already occupied."
            ])
            ->withInput();
    }
}