<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the registrar dashboard.
     */
    public function index()
    {
        return view('registrar.index'); // Create this Blade file
    }
}
