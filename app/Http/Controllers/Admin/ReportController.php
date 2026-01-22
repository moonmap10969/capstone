<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        // Fetch reports by type
        $performanceReports = Report::where('type', 'performance')->get();
        $financialReports   = Report::where('type', 'financial')->get();

        return view('admin.reports.index', compact('performanceReports', 'financialReports'));
    }
}
