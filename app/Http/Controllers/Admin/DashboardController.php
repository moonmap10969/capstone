<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admission;
use App\Models\Tuition;
use App\Models\AcademicYear;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'totalUsers' => User::count(),
            'totalAdmissions' => Admission::count(),
            'totalTuition' => Tuition::count(),
            'activeYear' => AcademicYear::where('is_current', true)->first(),
        ]);
    }
}