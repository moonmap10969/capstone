<?php 
namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class ClassListController extends Controller
{
   public function index()
{
    // Define the logical sequence for your school
    $customOrder = [
        'kinder1', 'kinder2', 'kinder2', 
        'grade1', 'grade2', 'grade3', 'grade4', 'grade5', 
        'grade6', 'grade7', 'grade8', 'grade9', 'grade10'
    ];

    // Sort the sections based on the custom list above
    $sections = Section::with(['enrollments.admission'])
        ->get()
        ->sortBy(function ($section) use ($customOrder) {
            $index = array_search($section->year_level, $customOrder);
            return $index !== false ? $index : 999;
        })
        ->groupBy('year_level');

    // The keys (year levels) will now follow the sorted order automatically
    $yearLevels = $sections->keys();

    return view('registrar.classlist.index', compact('sections', 'yearLevels'));
}
    
}