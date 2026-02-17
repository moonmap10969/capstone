<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        // Added withCount to fetch the number of students in each section
        $sections = Section::withCount('enrollments')->get();
        return view('registrar.sections.index', compact('sections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'section_id' => 'required|unique:sections,section_id',
            'capacity' => 'required|integer|min:1',
            'year_level' => 'required|string'
        ]);

        Section::create($validated);

        return redirect()->route('registrar.sections.index')
            ->with('success', 'Section created successfully!');
    }

    public function edit(Section $section)
    {
        return view('registrar.sections.edit', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'section_id' => 'required|unique:sections,section_id,' . $section->id,
            'capacity' => 'required|integer|min:1',
            'year_level' => 'required|string'
        ]);

        $section->update($validated);
        return redirect()->route('registrar.sections.index')->with('success', 'Section updated successfully!');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('registrar.sections.index')->with('success', 'Section deleted successfully!');
    }
}