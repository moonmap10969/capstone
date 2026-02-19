<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Auth controllers
use App\Http\Controllers\Auth\PasswordController;

// Public controllers
use App\Http\Controllers\AdmissionController;

// Admin controllers
use App\Http\Controllers\Admin\{
    UserController,
    AdminScheduleController,
    ReportController as AdminReportController,
    TuitionController as AdminTuitionController,
    DocumentController as AdminDocumentController,
    AdmissionController as AdminAdmissionController
};

// Student controllers
use App\Http\Controllers\Student\{
    StudentDashboardController,
    ScheduleController,
    DocumentController,
    TuitionController as StudentTuitionController
};

// Admissions Office
use App\Http\Controllers\Admissions\AdmissionsAdmissionController;

// Registrar controllers
use App\Http\Controllers\Registrar\{
    DashboardController as RegistrarDashboardController,
    EnrollmentController,
    SectionController,
    ClassListController,
    StudentController as RegistrarStudentController,
    ReportController as RegistrarReportController,
    GradesController,
    CurriculumController,
    SchedulingController,
    AttendanceController,
    DocumentController as RegistrarDocumentController,
    TuitionController as RegistrarTuitionController
};

// Teacher controllers
use App\Http\Controllers\Teacher\{
    GradeController,
    ClassListController as TeacherClasslistController,
    LessonController,
    ScheduleController as TeacherScheduleController
};

// Cashier controllers
use App\Http\Controllers\Cashier\{
    TuitionController as CashierTuitionController,
    DashboardController as CashierDashboardController,
    StudentController as CashierStudentController,
    DocumentController as CashierDocumentController,
    ReportController as CashierReportController
    
    
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
Route::get('/admissions-info', fn() => view('admissions'))->name('admissions');
Route::get('admissions/create', [AdmissionController::class, 'create'])->name('admissions.create');
Route::post('admissions', [AdmissionController::class, 'store'])->name('admissions.store');

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

        // Admissions
        Route::get('admissions', [AdmissionController::class, 'index'])->name('admissions.index');
        Route::get('admissions/documents', [AdmissionController::class, 'documents'])->name('admissions.documents');

        // Tuition
        Route::get('/tuition', [StudentTuitionController::class, 'index'])->name('tuition.index');
        Route::post('/tuition', [StudentTuitionController::class, 'store'])->name('tuition.store');

        // Documents
        Route::resource('documents', DocumentController::class)->only(['index', 'store', 'destroy']);

        // Protected routes after admission approval
        Route::middleware(['EnsureAdmissionApproved'])->group(function () {
            Route::get('/protected-dashboard', [ScheduleController::class, 'dashboard'])->name('approved.dashboard');
            Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
            Route::get('/grades', fn() => view('student.grades.index'))->name('grades.index');
        });
    });

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {
        Route::get('/dashboard', [TeacherScheduleController::class, 'index'])->name('dashboard');
        Route::get('/schedule', [TeacherScheduleController::class, 'index'])->name('schedule.index');

        // Classlist
        Route::get('/classlist', [TeacherClasslistController::class, 'index'])->name('classlist.index');
        Route::get('/classlist/{section}', [TeacherClasslistController::class, 'show'])->name('classlist.show');

        // Grades
        Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
        Route::get('/grades/{section}', [GradeController::class, 'show'])->name('grades.show');
        Route::post('/grades/store', [GradeController::class, 'store'])->name('grades.store');
        Route::patch('/grades/{grade}/update', [GradeController::class, 'update'])->name('grades.update');

        // Lessons
        Route::resource('lessons', LessonController::class);
    });

/*
|--------------------------------------------------------------------------
| Admissions Office Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:admissions'])
    ->prefix('admissions')
    ->name('admissions.')
    ->group(function () {
        Route::get('/', [AdmissionsAdmissionController::class, 'index'])->name('index');
        Route::get('/create', [AdmissionsAdmissionController::class, 'create'])->name('create');
        Route::get('{admission}', [AdmissionsAdmissionController::class, 'show'])->name('show');

        Route::patch('admissions/{admission}/approve', [AdmissionsAdmissionController::class, 'approve'])->name('approve');
        Route::patch('admissions/{admission}/reject', [AdmissionsAdmissionController::class, 'reject'])->name('reject');
    });

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', fn() => view('admin.index'))->name('index');

        Route::resources([
            'users' => UserController::class,
            'documents' => AdminDocumentController::class,
            'tuitions' => AdminTuitionController::class,
            'schedule' => AdminScheduleController::class,
        ]);
    });

/*
|--------------------------------------------------------------------------
| Registrar Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:registrar'])
    ->prefix('registrar')
    ->name('registrar.')
    ->group(function () {
        Route::get('/', [RegistrarDashboardController::class, 'index'])->name('index');

        Route::resource('students', RegistrarStudentController::class);
        Route::resource('enrollment', EnrollmentController::class);
        Route::resource('tuitions', RegistrarTuitionController::class);
        Route::resource('sections', SectionController::class);

        Route::patch('tuitions/{tuition}/approve', [RegistrarTuitionController::class, 'approve'])->name('tuitions.approve');

        Route::get('/classlist', [ClassListController::class, 'index'])->name('classlist.index');
        Route::get('/classlist/{section}/export', [ClassListController::class, 'export'])->name('classlist.export');
        Route::get('/classlist/{section}/download', [ClassListController::class, 'downloadPdf'])->name('classlist.download');

        Route::prefix('reports')->name('')->group(function () {
            Route::get('/enrollment-summary', [RegistrarReportController::class, 'enrollmentSummary'])->name('reports.enrollment-summary');
            Route::get('/payment-reports', [RegistrarReportController::class, 'paymentReports'])->name('reports.payment-reports');
        });
    });

/*
|--------------------------------------------------------------------------
| Cashier Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:cashier'])
    ->prefix('cashier')
    ->name('cashier.')
    ->group(function () {
        Route::get('/', [CashierDashboardController::class, 'index'])->name('index');

        Route::resource('students', CashierStudentController::class)->only(['index', 'show']);
        Route::get('enrollment', [EnrollmentController::class, 'index'])->name('enrollment');
        Route::get('documents', [CashierDocumentController::class, 'index'])->name('documents');
        Route::resource('tuitions', CashierTuitionController::class);

        Route::patch('tuitions/{tuition}/approve', [CashierTuitionController::class, 'approve'])->name('tuitions.approve');
        Route::patch('tuitions/{tuition}/reject', [CashierTuitionController::class, 'reject'])->name('tuitions.reject');

        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('enrollment-summary', [CashierReportController::class, 'enrollmentSummary'])->name('enrollment-summary');
            Route::get('payment-reports', [CashierReportController::class, 'paymentReports'])->name('payment-reports');
        });
    });


    Route::middleware(['auth', 'verified', 'role:cashier'])
    ->prefix('cashier')
    ->name('cashier.')
    ->group(function () {
        Route::get('/', [CashierDashboardController::class, 'index'])->name('index');
        Route::get('/index', [CashierDashboardController::class, 'index']); // optional duplicate
    });

require __DIR__ . '/auth.php';


