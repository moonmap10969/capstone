<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Admission;
use Illuminate\Http\Request;

class DashboardController extends Controller{

   public function index()
    {
        $incomeStats = Admission::selectRaw('household_income, count(*) as count')
            ->whereNotNull('household_income')
            ->groupBy('household_income')
            ->pluck('count', 'household_income');

        $employmentStats = Admission::selectRaw('employment_status, count(*) as count')
            ->whereNotNull('employment_status')
            ->groupBy('employment_status')
            ->pluck('count', 'employment_status');

        $avgHouseholdSize = Admission::avg('household_size');
        $totalAdmissions = Admission::count();
        $totalUsers = \App\Models\User::count();
        $activeYear = \App\Models\AcademicYear::where('is_current', true)->first();
        $totalTuition = 0; // Placeholder for your tuition logic

        return view('admin.index', compact(
            'incomeStats', 
            'employmentStats', 
            'avgHouseholdSize',
            'totalAdmissions',
            'totalUsers',
            'activeYear',
            'totalTuition'
        ));
    }
}