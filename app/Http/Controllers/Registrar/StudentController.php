<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registrar\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('registrar.students', compact('students'));
    }

    public function create()
    {
        return view('registrar.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'grade_level' => 'required|integer',
            'email' => 'required|email|unique:students,email',
        ]);

        Student::create($validated);

        return redirect()->route('registrar.students.index')->with('success', 'Student added.');
    }

    public function show(Student $student)
    {
        return view('registrar.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('registrar.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'grade_level' => 'required|integer',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ]);

        $student->update($validated);

        return redirect()->route('registrar.students.index')->with('success', 'Student updated.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('registrar.students.index')->with('success', 'Student removed.');
    }
}
