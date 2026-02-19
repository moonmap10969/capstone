<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;

class GradeController extends Controller
{
    /**
     * Display a listing of the sections assigned to the logged-in teacher.
     */
    public function index()
    {
        // Get all sections that have schedules for this teacher
        $sections = Section::whereHas('schedules', function ($query) {
            $query->where('teacher', auth()->user()->name);
        })->get();

        return view('teacher.grades.index', compact('sections'));
    }
}
