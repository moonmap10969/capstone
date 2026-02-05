<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\{
    UserController, 
    AdminScheduleController, 
    ReportController as AdminReportController, 
    TuitionController as AdminTuitionController, 
    DocumentController as AdminDocumentController, 
    AdmissionController as AdminAdmissionController
};

use App\Http\Controllers\Student\{
    StudentDashboardController, AdmissionController, ScheduleController, DocumentController, TuitionController as StudentTuitionController
};
use App\Http\Controllers\Registrar\{
    DashboardController as RegistrarDashboardController, EnrollmentController, StudentController, ReportController, GradesController, CurriculumController, SchedulingController, AttendanceController, DocumentController as RegistrarDocumentController, TuitionController as RegistrarTuitionController
};

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'))->name('welcome');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/education', fn() => view('education'))->name('education');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::get('/admissions', fn() => view('admissions'))->name('admissions');


 
Route::post('admissions', [DocumentController::class, 'store'])->name('admissions.store');
Route::post('admissions', [AdmissionController::class, 'store'])->name('admissions.store');
/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:student'])->prefix('student')->name('student.')->group(function () {
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('student.dasboard');
    // Admissions
    Route::get('admissions', [AdmissionController::class, 'index'])->name('admissions.index');
    Route::get('admissions/create', [AdmissionController::class, 'create'])->name('admissions.create');
    Route::get('admissions/documents', [AdmissionController::class, 'documents'])->name('admissions.documents');
  
    // Tuition
    Route::get('/tuition', [StudentTuitionController::class, 'index'])->name('tuition.index');
    Route::post('/tuition', [StudentTuitionController::class, 'store'])->name('tuition.store');
    
    // Documents (Student Portal)
    Route::get('documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::post('documents/upload', [DocumentController::class, 'store'])->name('documents.upload');
    Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');

    // Protected Student Routes (Approved students only)
    Route::middleware(['EnsureAdmissionApproved'])->group(function () {
        Route::get('/', [StudentDashboardController::class, 'index'])->name('index');
       Route::get('/dashboard', [ScheduleController::class, 'dashboard'])->name('dashboard');
        Route::get('tuition', [StudentTuitionController::class, 'index'])->name('tuition.index');
        Route::get('grades', fn() => view('student.grades.index'))->name('grades.index');
        
        // Corrected Schedule Route
        Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    });
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', fn() => view('admin.index'))->name('index');

    Route::resource('users', UserController::class);
    Route::resource('admissions', AdminAdmissionController::class);
    Route::resource('documents', AdminDocumentController::class);
    Route::resource('tuitions', AdminTuitionController::class);
    Route::resource('reports', AdminReportController::class);
    Route::resource('schedule', AdminScheduleController::class);

    // Approvals
    Route::patch('admissions/{admission}/approve', [AdminAdmissionController::class, 'approve'])->name('admissions.approve');
    Route::patch('admissions/{admission}/reject', [AdminAdmissionController::class, 'reject'])->name('admissions.reject');
    Route::patch('documents/{document}/approve', [AdminDocumentController::class, 'approve'])->name('documents.approve');
    Route::patch('documents/{document}/reject', [AdminDocumentController::class, 'reject'])->name('documents.reject');

    // Schedule
    Route::get('/admin/schedule', [AdminScheduleController::class, 'index'])->name('admin.schedule.index');
    Route::get('/admin/schedule/create', [AdminScheduleController::class, 'create'])->name('admin.schedule.create');
    Route::post('/admin/schedule', [AdminScheduleController::class, 'store'])->name('admin.schedule.store');
    Route::get('/admin/schedule/{schedule}/edit', [AdminScheduleController::class, 'edit'])->name('admin.schedule.edit');
    Route::put('/admin/schedule/{schedule}', [AdminScheduleController::class, 'update'])->name('admin.schedule.update');
    Route::delete('/admin/schedule/{schedule}', [ScheduleController::class, 'destroy'])->name('admin.schedule.destroy');
});

/*
|--------------------------------------------------------------------------
| Registrar Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('registrar')->name('registrar.')->group(function () {
    Route::get('/', [RegistrarDashboardController::class, 'index'])->name('index');
    
    // Core Modules
    Route::resource('students', RegistrarStudentController::class);
    Route::get('enrollment', [EnrollmentController::class, 'index'])->name('enrollment');
    Route::get('documents', [RegistrarDocumentController::class, 'index'])->name('documents');
    
    // Tuition Management (Standardized as Resource for Registrar)
    Route::resource('tuitions', RegistrarTuitionController::class);
    Route::patch('tuitions/{tuition}/approve', [RegistrarTuitionController::class, 'approve'])->name('tuitions.approve');
    Route::patch('tuitions/{tuition}/reject', [RegistrarTuitionController::class, 'reject'])->name('tuitions.reject');

    // Reports
    Route::prefix('reports')->name('reports.')->group(function() {
        Route::get('/enrollment-summary', [RegistrarReportController::class, 'enrollmentSummary'])->name('enrollment-summary');
        Route::get('/payment-reports', [RegistrarReportController::class, 'paymentReports'])->name('payment-reports');
    });
});

/*
|--------------------------------------------------------------------------
| Specialized Role Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/school-admin', fn() => view('school-admin.index'))->name('school-admin.index');
    Route::get('/adviser', fn() => view('adviser.index'))->name('adviser.index');
    Route::get('/teacher', fn() => view('teacher.index'))->name('teacher.index');
    Route::get('/parent', fn() => view('parent.index'))->name('parent.index');
});

require __DIR__ . '/auth.php';
