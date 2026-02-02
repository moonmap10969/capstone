<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class TuitionController extends Controller
{
    public function index()
    {
        return view('student.tuition.index');
    }
}
