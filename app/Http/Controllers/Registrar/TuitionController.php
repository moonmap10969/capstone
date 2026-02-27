<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use App\Models\Tuition;
use App\Models\Admission;
use App\Models\FeeStructure;
use Illuminate\Http\Request;

class TuitionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $gradeFilter = $request->get('grade_filter');
        $gradeOrder = ['kinder1', 'kinder2', 'kinder3', 'grade1', 'grade2', 'grade3', 'grade4', 'grade5', 'grade6', 'grade7', 'grade8', 'grade9', 'grade10'];

        $feeStructures = FeeStructure::all()->keyBy('year_level');

        $students = Admission::with('tuition')
            ->when($search, function($q) use ($search) {
                $q->where(function($query) use ($search) {
                    $query->where('studentFirstName', 'like', "%{$search}%")
                          ->orWhere('studentLastName', 'like', "%{$search}%")
                          ->orWhere('studentNumber', 'like', "%{$search}%");
                });
            })
            ->when($gradeFilter, fn($q) => $q->where('year_level', $gradeFilter))
            ->orderBy('studentLastName')
            ->paginate(20) 
            ->appends($request->all());

        return view('registrar.tuitions.index', compact('students', 'gradeOrder', 'feeStructures'));
    }

    public function create()
    {
        $gradeOrder = ['kinder1', 'kinder2', 'kinder3', 'grade1', 'grade2', 'grade3', 'grade4', 'grade5', 'grade6', 'grade7', 'grade8', 'grade9', 'grade10'];
        $feeStructures = FeeStructure::all()->keyBy('year_level');

        $students = Admission::all()->mapWithKeys(function ($student) {
            return [$student->studentNumber => [
                'name' => $student->studentLastName . ', ' . $student->studentFirstName,
                'year_level' => $student->year_level,
            ]];
        });

        return view('registrar.tuitions.create', compact('gradeOrder', 'feeStructures', 'students'));
    }

    public function store(Request $request)
    {
        $preset = FeeStructure::where('year_level', $request->year_level)->first();
        if (!$preset) return back()->with('error', "Rates for {$request->year_level} not found.");

        $affiliationDiscount = ($request->umc_affiliation === 'worker') ? 1.0 : (($request->umc_affiliation === 'member') ? 0.5 : 0);
        $siblingDiscount = ['none' => 0, '2nd' => 0.10, '3rd' => 0.20, '4th' => 0.30][$request->sibling_order] ?? 0;

        $finalDiscountRate = max($affiliationDiscount, $siblingDiscount);

        $baseTuition = (float) $preset->base_tuition;
        $miscFees = (float) $preset->total_misc;
        $netTuition = $baseTuition * (1 - $finalDiscountRate);
        $totalAmount = $netTuition + $miscFees;

        
        Tuition::updateOrCreate(
        ['studentNumber' => $request->studentNumber],
        [
            'name' => $request->name,
            'year_level' => $request->year_level,
            'umc_affiliation' => $request->umc_affiliation, 
            'sibling_order' => $request->sibling_order,     
            'tuition_fee' => $netTuition,
            'misc_fees' => $preset->total_misc,
            'amount' => $totalAmount,
            'balance' => $totalAmount,
            'status' => 'finalized'
        ]
    );

        return back()->with('success', 'Assessment finalized and synced to Cashier.');
    }

   public function updateFeeStructures(Request $request)
{
    $validated = $request->validate([
        'year_level' => 'required|string',
        'base_tuition' => 'required|numeric|min:0',
        // ... (keep your other validation keys here)
    ]);

    $miscKeys = ['reg_fee', 'learning_materials', 'medical_dental', 'testing_materials', 'id_fee', 'insurance', 'av_computer', 'handbook', 'athletes', 'red_cross', 'energy_fee', 'membership_fees', 'prisap_umesa', 'hgp_modules', 'lab_fees'];
    
    $totalMisc = 0;
    foreach ($miscKeys as $key) {
        $totalMisc += (float) ($request->input($key) ?? 0);
    }

    // 1. Save the Master Fee
    $feeStructure = FeeStructure::updateOrCreate(
        ['year_level' => $request->year_level],
        array_merge($request->all(), ['total_misc' => $totalMisc])
    );

    // 2. Automatically sync this new rate to all students in this grade
    $students = Admission::where('year_level', $request->year_level)->get();
    foreach ($students as $student) {
        Tuition::updateOrCreate(
            ['studentNumber' => $student->studentNumber],
            [
                'name'        => $student->studentLastName . ', ' . $student->studentFirstName,
                'year_level'  => $student->year_level,
                'tuition_fee' => (float) $feeStructure->base_tuition,
                'misc_fees'   => (float) $totalMisc,
                'amount'      => (float) ($feeStructure->base_tuition + $totalMisc),
                'balance'     => (float) ($feeStructure->base_tuition + $totalMisc),
                'status'      => 'pending'
            ]
        );
    }

    return redirect()->route('registrar.tuitions.create')
        ->with('success', "Master fees for {$request->year_level} updated and synced to all students.");
}

    public function syncAllAssessments()
    {
        $feeStructures = FeeStructure::all()->keyBy('year_level');
        $students = Admission::all();
        $count = 0;

        foreach ($students as $student) {
            $preset = $feeStructures->get($student->year_level);
            
            if ($preset) {
                Tuition::updateOrCreate(
                    ['studentNumber' => $student->studentNumber],
                    [
                        'name'        => $student->studentLastName . ', ' . $student->studentFirstName,
                        'year_level'  => $student->year_level, // Fixes the NULL column
                        'tuition_fee' => (float) $preset->base_tuition,
                        'misc_fees'   => (float) $preset->total_misc,
                        'amount'      => (float) ($preset->base_tuition + $preset->total_misc),
                        'balance'     => (float) ($preset->base_tuition + $preset->total_misc),
                        'status'      => 'pending'
                    ]
                );
                $count++;
            }
        }

        return back()->with('success', "Successfully synced $count students to the Cashier view.");
    }
}