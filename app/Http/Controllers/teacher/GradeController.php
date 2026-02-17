<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;

class GradeController extends Controller
{
    public function index()
    {
        return view('teacher.grades.index');
    }
}
