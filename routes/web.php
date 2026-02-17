<?php

use Illuminate\Support\Facades\{Route, Auth};
use App\Http\Controllers\Auth\PasswordController;

use App\Http\Controllers\ {
    AdmissionController
};
use App\Http\Controllers\Admin\{
    UserController, AdminScheduleController, ReportController as AdminReportController, 
    TuitionController as AdminTuitionController, DocumentController as AdminDocumentController, 
    AdmissionController as AdminAdmissionController
};
use App\Http\Controllers\Student\{
    StudentDashboardController, ScheduleController, 
    DocumentController, TuitionController as StudentTuitionController
};
use App\Http\Controllers\Admissions\AdmissionsAdmissionController;
use App\Http\Controllers\Registrar\{
    DashboardController as RegistrarDashboardController, EnrollmentController, SectionController,
    StudentController as RegistrarStudentController, ReportController as RegistrarReportController,
    GradesController, CurriculumController, SchedulingController, AttendanceController, 
    DocumentController as RegistrarDocumentController, TuitionController as RegistrarTuitionController
};
use App\Http\Controllers\Teacher\{GradeController, LessonController, ScheduleController as TeacherScheduleController};

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'))->name('welcome');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/education', fn() => view('education'))->name('education');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::get('/student/admissions-info', [AdmissionController::class, 'index'])->name('public.admissions');
Route::post('/student/admissions-info', [AdmissionController::class, 'store'])->name('admissions.store');
/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    
    // Admissions logic for the student
    Route::get('admissions', [AdmissionController::class, 'index'])->name('admissions.index');
    Route::get('admissions/create', [AdmissionController::class, 'create'])->name('admissions.create');
    Route::get('admissions/documents', [AdmissionController::class, 'documents'])->name('admissions.documents');

    Route::get('/tuition', [StudentTuitionController::class, 'index'])->name('tuition.index');
    Route::post('/tuition', [StudentTuitionController::class, 'store'])->name('tuition.store');
    
    Route::resource('documents', DocumentController::class)->only(['index', 'store', 'destroy']);

    Route::middleware(['EnsureAdmissionApproved'])->group(function () {
        Route::get('/protected-dashboard', [ScheduleController::class, 'dashboard'])->name('approved.dashboard');
        Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
        Route::get('/grades', fn() => view('student.grades.index'))->name('grades.index');
    });
});

/*
|--------------------------------------------------------------------------
| Admissions Office Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:admissions'])->prefix('admissions')->name('admissions.')->group(function () {
    Route::get('/', [AdmissionsAdmissionController::class, 'index'])->name('index');
    Route::get('/create', [AdmissionsAdmissionController::class, 'create'])->name('create'); // Add this
    Route::post('/', [AdmissionsAdmissionController::class, 'store'])->name('store'); // Add this
    Route::get('{admission}', [AdmissionsAdmissionController::class, 'show'])->name('show');


    Route::patch('admissions/{admission}/approve', [AdmissionsAdmissionController::class, 'approve'])->name('approve');
    Route::patch('admissions/{admission}/reject', [AdmissionsAdmissionController::class, 'reject'])->name('reject');
});

/*
|--------------------------------------------------------------------------
| Admin & Registrar Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => view('admin.index'))->name('index');
    Route::resources([
        'users' => UserController::class,
        'documents' => AdminDocumentController::class,
        'tuitions' => AdminTuitionController::class,
        'schedule' => AdminScheduleController::class,
    ]);
});

Route::middleware(['auth', 'verified', 'role:registrar'])->prefix('registrar')->name('registrar.')->group(function () {
    Route::get('/', [RegistrarDashboardController::class, 'index'])->name('index');
    Route::resource('students', RegistrarStudentController::class);
    Route::resource('enrollment', EnrollmentController::class);
    Route::resource('tuitions', RegistrarTuitionController::class);
    Route::resource('sections', SectionController::class);
    Route::patch('tuitions/{tuition}/approve', [RegistrarTuitionController::class, 'approve'])->name('tuitions.approve');

Route::prefix('reports')->name('')->group(function() {
    Route::get('/enrollment-summary', [RegistrarReportController::class, 'enrollmentSummary'])->name('reports.enrollment-summary');
    Route::get('/payment-reports', [RegistrarReportController::class, 'paymentReports'])->name('reports.payment-reports');
});
});

require __DIR__ . '/auth.php';