<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registrar\Student; // assuming enrollments are tied to students

class EnrollmentController extends Controller
{
    public function index()
    {
        $students = Student::all(); // or filter by enrollment status
        return view('registrar.enrollment', compact('students'));
    }
}
