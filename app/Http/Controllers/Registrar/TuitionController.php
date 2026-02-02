<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tuition;

class TuitionController extends Controller
{
    public function index()
    {
        $tuitions = Tuition::all();
        return view('registrar.tuition', compact('tuitions'));
    }

    public function show(Tuition $tuition)
    {
        return view('registrar.tuitions.show', compact('tuition'));
    }

    public function approve(Tuition $tuition)
    {
        $tuition->status = 'approved';
        $tuition->save();

        return redirect()->route('registrar.tuitions.index')->with('success', 'Tuition approved.');
    }

    public function reject(Tuition $tuition)
    {
        $tuition->status = 'rejected';
        $tuition->save();

        return redirect()->route('registrar.tuitions.index')->with('error', 'Tuition rejected.');
    }
}
