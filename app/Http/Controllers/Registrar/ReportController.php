<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function enrollmentSummary()
    {
        // Views should be in resources/views/registrar/reports/
        return view('registrar.reports.enrollment-summary');
    }

    public function paymentReports()
    {
        return view('registrar.reports.payment-reports');
    }
}
