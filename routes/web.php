<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\AdmissionController as AdminAdmissionController;
use App\Http\Controllers\Admin\TuitionController as AdminTuitionController;
use App\Http\Controllers\Student\TuitionController as StudentTuitionController;
use App\Http\Controllers\Student\AdmissionController;
use App\Http\Controllers\Auth\PasswordController as PasswordController;
use App\Http\Controllers\Student\DocumentController;
use App\Http\Controllers\Registrar\StudentController as RegistrarStudentController;
use App\Http\Controllers\Registrar\AdmissionController as RegistrarAdmissionController;
use App\Http\Controllers\Registrar\DocumentController as RegistrarDocumentController;
use App\Http\Controllers\Registrar\TuitionController as RegistrarTuitionController;
use App\Http\Controllers\Registrar\DashboardController;
use App\Http\Controllers\Registrar\StudentController;
use App\Http\Controllers\Registrar\GradesController;
use App\Http\Controllers\Registrar\CurriculumController;
use App\Http\Controllers\Registrar\SchedulingController;
use App\Http\Controllers\Registrar\AttendanceController;
use App\Http\Controllers\Registrar\EnrollmentController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Registrar\ReportController as RegistrarReportController;

use App\Http\Controllers\Registrar\ReportController;

Route::prefix('registrar')->group(function () {
    Route::get('enrollment-summary', [ReportController::class, 'enrollmentSummary'])
        ->name('reports.enrollment-summary');

    Route::get('payment-reports', [ReportController::class, 'paymentReports'])
        ->name('reports.payment-reports');
});

Route::prefix('registrar')->group(function () {
    Route::get('enrollment-summary', [ReportController::class, 'enrollmentSummary'])
        ->name('reports.enrollment-summary');

    Route::get('payment-reports', [ReportController::class, 'paymentReports'])
        ->name('reports.payment-reports');
});


/*
|--------------------------------------------------------------------------
| School Admin Routes (requires login & verified)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('school-admin')->name('school-admin.')->group(function () {
    Route::get('/', fn() => view('school-admin.index'))->name('index');
    // Add more school admin resources if needed
});

/*
|--------------------------------------------------------------------------
| Class Adviser / Homeroom Teacher Routes (requires login & verified)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('adviser')->name('adviser.')->group(function () {
    Route::get('/', fn() => view('adviser.index'))->name('index');
    // Add more adviser-specific routes here, e.g., students, grades
});

/*
-----------------------------------------------------------------------
| Class Adviser / Homeroom Teacher Routes (requires login & verified)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/', fn() => view('teacher.index'))->name('index');
    // Add more adviser-specific routes here, e.g., students, grades
});



/*
|--------------------------------------------------------------------------
| Parent / Guardian Routes (requires login & verified)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('parent')->name('parent.')->group(function () {
    Route::get('/', fn() => view('parent.index'))->name('index');
    // Add more parent-specific routes here, e.g., view child’s grades, tuition
});


/*
|--------------------------------------------------------------------------
| Registrar Routes (requires login & verified)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])
    ->prefix('registrar')
    ->name('registrar.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::resource('students', StudentController::class);

  // Enrollment route named exactly registrar.enrollment
  Route::get('enrollment', [EnrollmentController::class, 'index'])
  ->name('enrollment'); // <-- this sets route name to registrar.enrollment
  

  Route::get('documents', [RegistrarDocumentController::class, 'index'])
  ->name('documents'); // <-- this sets route name to registrar.enrollment

  Route::get('tuition', [RegistrarTuitionController::class, 'index'])
  ->name('tuition'); // <-- this sets route name to registrar.enrollment


  Route::prefix('registrar')->group(function () {
      // Enrollment Summary
      Route::get('enrollment-summary', [ReportController::class, 'enrollmentSummary'])
          ->name('reports.enrollment-summary');
  
      // Payment Reports
      Route::get('payment-reports', [ReportController::class, 'paymentReports'])
          ->name('reports.payment-reports');
  });
  
});
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/



Route::get('/', fn() => view('welcome'))->name('welcome');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/education', fn() => view('education'))->name('education');
Route::get('/contact', fn() => view('contact'))->name('contact');

// Public admissions page (no login required)
Route::get('/admissions', fn() => view('admissions'))->name('admissions');
Route::post('/admissions', [AdmissionController::class, 'store'])->name('admissions.store');

/*
|--------------------------------------------------------------------------
| Student Routes (requires login & verified)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', fn() => view('student.index'))->name('dashboard');
 

    // Dashboard
    Route::get('/', fn() => view('student.index'))->name('index');
    Route::get('/dashboard', fn() => view('student.index'))->name('dashboard');

    // Admissions
    Route::get('admissions', [AdmissionController::class, 'index'])->name('admissions.index');
    Route::get('admissions/create', [AdmissionController::class, 'create'])->name('admissions.create');
    Route::post('admissions', [AdmissionController::class, 'store'])->name('admissions.store');

    // Admission-specific documents (latest admission)
    Route::get('admissions/documents', [AdmissionController::class, 'documents'])->name('admissions.documents');
    Route::post('admissions/documents/upload', [AdmissionController::class, 'uploadDocuments'])->name('admissions.documents.upload');

    Route::get('admissions/payment', [AdmissionController::class, 'payment'])->name('admissions.payment');


    // Extra student documents (general)
    Route::get('documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::post('documents/upload', [DocumentController::class, 'upload'])->name('documents.upload');

    // Tuitions & Reports
    Route::get('tuition', [StudentTuitionController::class, 'index'])
        ->name('tuition.index');


    Route::get('grades', fn() => view('student.grades.index'))->name('grades.index');
});




Route::get('/student/tuition', [StudentTuitionController::class, 'index'])
    ->name('student.tuition.index');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Standard Resource Routes (index, create, store, edit, update, destroy)

     Route::get('/', fn() => view('admin.index'))->name('index');

    Route::resource('users', UserController::class);
    Route::resource('documents', AdminDocumentController::class);
    Route::resource('admissions', AdminAdmissionController::class);
    Route::resource('tuitions', AdminTuitionController::class);
    Route::resource('reports', ReportController::class);

    // Approvals
    Route::patch('documents/{document}/approve', [AdminDocumentController::class, 'approve'])->name('documents.approve');
    Route::patch('documents/{document}/reject', [AdminDocumentController::class, 'reject'])->name('documents.reject');
    Route::patch('tuitions/{tuition}/approve', [AdminTuitionController::class, 'approve'])->name('tuitions.approve');
    Route::patch('tuitions/{tuition}/reject', [AdminTuitionController::class, 'reject'])->name('tuitions.reject');
    Route::patch('admissions/{admission}/approve', [AdminAdmissionController::class, 'approve'])->name('admissions.approve');
    Route::patch('admissions/{admission}/reject', [AdminAdmissionController::class, 'reject'])->name('admissions.reject');
    
    Route::resource('admissions', AdminAdmissionController::class);

    // Specific Action Routes for FUMCES Admission Workflow
    // These must use PATCH to match your <button> methods
    Route::patch('admissions/{admission}/approve', [AdminAdmissionController::class, 'approve'])->name('admissions.approve');
    Route::patch('admissions/{admission}/reject', [AdminAdmissionController::class, 'reject'])->name('admissions.reject');
    
    // Resource routes for other modules
    Route::resource('users', UserController::class);
    Route::resource('documents', AdminDocumentController::class);
    Route::resource('tuitions', AdminTuitionController::class);
});



/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Define this separately so they can actually access it
Route::middleware(['auth'])->group(function () {
    Route::get('/change-password', [PasswordController::class, 'showChangeForm'])->name('password.change');
    Route::post('/change-password', [PasswordController::class, 'updatePassword'])->name('password.update');
});

require __DIR__ . '/auth.php';

