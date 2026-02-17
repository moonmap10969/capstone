<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /**
     * Display a listing of the lessons.
     */
    public function index()
    {
        $lessons = Lesson::latest()->get();
        return view('teacher.lessons.index', compact('lessons'));
    }

    /**
     * Store a newly created lesson in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240', // 10MB limit
        ]);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('lessons', 'public');
        }

        // Default status for new lessons is draft
        $validated['status'] = 'draft';

        Lesson::create($validated);

        return redirect()->route('teacher.lessons.index')
            ->with('success', 'Lesson created successfully!');
    }

    /**
     * Show the form for editing the specified lesson.
     */
    public function edit(Lesson $lesson)
    {
        return view('teacher.lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified lesson in storage.
     * This handles both full form updates and the index dropdown status change.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'subject' => 'sometimes|required|string',
            'date' => 'sometimes|required|date',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:draft,ready,completed',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        ]);

        // Handle File Update
        if ($request->hasFile('file')) {
            // Delete the old file from storage if a new one is uploaded
            if ($lesson->file_path && Storage::disk('public')->exists($lesson->file_path)) {
                Storage::disk('public')->delete($lesson->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('lessons', 'public');
        }

        $lesson->update($validated);

        // If the request is just a status update from the index dropdown, 
        // return back instead of a full redirect to maintain scroll position.
        if ($request->has('status') && !$request->has('title')) {
            return back()->with('success', 'Status updated to ' . ucfirst($request->status));
        }

        return redirect()->route('teacher.lessons.index')
            ->with('success', 'Lesson updated successfully!');
    }

    /**
     * Remove the specified lesson from storage.
     */
    public function destroy(Lesson $lesson)
    {
        // Remove associated file from storage before deleting the record
        if ($lesson->file_path && Storage::disk('public')->exists($lesson->file_path)) {
            Storage::disk('public')->delete($lesson->file_path);
        }
        
        $lesson->delete();

        return back()->with('success', 'Lesson deleted successfully!');
    }
}