<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Auth controllers
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

// Public controllers
use App\Http\Controllers\AdmissionController;

// Admin controllers
use App\Http\Controllers\Admin\{
    UserController,
    AdminScheduleController,
    ReportController as AdminReportController,
    TuitionController as AdminTuitionController,
    DocumentController as AdminDocumentController,
    SectionController as AdminSectionsController,
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
    ReportController as CashierReportController,
    PaymentController as CashierPaymentController
};
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    
    $user = $request->user();
    
    // Redirect based on role
    return match($user->role) {
        'admin'      => redirect()->route('admin.index'),
        'student'    => redirect()->route('student.dashboard'),
        'teacher'    => redirect()->route('teacher.dashboard'),
        'registrar'  => redirect()->route('registrar.index'),
        'cashier'    => redirect()->route('cashier.index'),
        'admissions' => redirect()->route('admissions.index'),
        default      => redirect('/'),
    };
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');
// Fix for the reset token route
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password-action', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update_final');

Route::get('/', fn() => view('welcome'))->name('welcome');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/education', fn() => view('education'))->name('education');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::get('/admissions-info', fn() => view('admissions'))->name('admissions');
Route::get('admissions/create', [AdmissionController::class, 'create'])->name('admissions.create');
// Add proper store route for admissions
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
        // Dashboard & Schedule
        Route::get('/dashboard', [TeacherScheduleController::class, 'index'])->name('dashboard');
        Route::get('/schedule', [TeacherScheduleController::class, 'index'])->name('schedule.index');

        // Grades Section (Matches folder: teacher/grades)
        Route::prefix('grades')->name('grades.')->group(function () {
            Route::get('/', [GradeController::class, 'index'])->name('index'); 
            Route::post('/store', [GradeController::class, 'store'])->name('store');
            Route::delete('/destroy/{id}', [GradeController::class, 'destroy'])->name('destroy');
            
            // Items
            Route::post('/items/store', [GradeController::class, 'storeItem'])->name('items.store');
            Route::delete('/items/destroy/{id}', [GradeController::class, 'destroyItem'])->name('items.destroy');
            
            // Attendance & Scores
            Route::post('/attendance/store', [GradeController::class, 'storeAttendance'])->name('attendance.store');
            Route::post('/scores/store', [GradeController::class, 'storeScores'])->name('scores.store');

            Route::post('/compute/{sectionId}', [GradeController::class, 'computeGrades'])->name('compute');
        });

        // Classlist
        Route::get('/classlist', [TeacherClasslistController::class, 'index'])->name('classlist.index');
        Route::get('/classlist/{section}', [TeacherClasslistController::class, 'show'])->name('classlist.show');
        
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
            'sections' => AdminSectionsController::class,
        ]);
    });

/*
|--------------------------------------------------------------------------
| Registrar Routes (First Block)
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
| Registrar Routes (Second Block)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:registrar'])
    ->prefix('registrar')
    ->name('registrar.')
    ->group(function () {
        
        Route::get('/', [RegistrarDashboardController::class, 'index'])->name('index');

        // Tuition Management
        Route::get('/tuitions', [RegistrarTuitionController::class, 'index'])->name('tuitions.index');
        Route::post('/tuitions', [RegistrarTuitionController::class, 'store'])->name('tuitions.store');
        Route::post('/fee-structures/update', [RegistrarTuitionController::class, 'updateFeeStructures'])->name('fee-structures.update');
        Route::post('/tuitions/sync-all', [RegistrarTuitionController::class, 'syncAllAssessments'])->name('tuitions.sync-all');
        
        Route::post('tuitions/update-config', [RegistrarTuitionController::class, 'updateConfig'])->name('tuitions.updateConfig');
        Route::patch('tuitions/{tuition}/approve', [RegistrarTuitionController::class, 'approve'])->name('tuitions.approve');

        // Student & Enrollment Resources
        Route::resource('students', RegistrarStudentController::class);
        Route::resource('enrollment', EnrollmentController::class);

        // Academic Management
        Route::get('/classlist', [ClassListController::class, 'index'])->name('classlist.index');
        Route::get('/classlist/{section}/export', [ClassListController::class, 'export'])->name('classlist.export');
        Route::get('/classlist/{section}/download', [ClassListController::class, 'downloadPdf'])->name('classlist.download');

        // Reports
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/enrollment-summary', [RegistrarReportController::class, 'enrollmentSummary'])->name('enrollment-summary');
            Route::get('/payment-reports', [RegistrarReportController::class, 'paymentReports'])->name('payment-reports');
        });
    });
/*
|--------------------------------------------------------------------------
| Cashier Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:cashier'])
    ->prefix('cashier')
    ->name('cashier.') // This automatically adds 'cashier.' to all names below
    ->group(function () {
        Route::get('/', [CashierDashboardController::class, 'index'])->name('index');

        // Students
        Route::resource('students', CashierStudentController::class)->only(['index', 'show']);

        // Enrollment
        Route::get('enrollment', [EnrollmentController::class, 'index'])->name('enrollment');

        // Tuitions
        Route::resource('tuitions', CashierTuitionController::class);
        Route::patch('tuitions/{tuition}/approve', [CashierTuitionController::class, 'approve'])->name('tuitions.approve');
        Route::patch('tuitions/{tuition}/reject', [CashierTuitionController::class, 'reject'])->name('tuitions.reject');
        Route::patch('tuitions/{tuition}/set-payment', [CashierTuitionController::class, 'setPayment'])->name('tuitions.setPayment');

        // Payments
        // Inside your existing Route::name('cashier.') group:
Route::prefix('payments')->name('payments.')->group(function () {
    Route::get('/', [CashierPaymentController::class, 'index'])->name('index');
    Route::get('/create', [CashierPaymentController::class, 'create'])->name('create');
    Route::post('/', [CashierPaymentController::class, 'store'])->name('store');
    
    // The specific route causing your error
    Route::get('/{payment}/edit', [CashierPaymentController::class, 'edit'])->name('edit');
    
    // Update route - use match to support both PUT and PATCH from your forms
    Route::match(['put', 'patch'], '/{payment}', [CashierPaymentController::class, 'update'])->name('update');
    
    Route::delete('/{payment}', [CashierPaymentController::class, 'destroy'])->name('destroy');
    
    // For the "Verify" button in your index
    Route::post('/{id}/approve', [CashierPaymentController::class, 'approveOnline'])->name('approve');
});
        // FIX: Remove 'cashier.' from the name here because it's inherited from the group
        Route::post('payments/approve/{id}', [CashierPaymentController::class, 'approveOnline'])->name('approve.payment');

        // **View encrypted receipt**
        Route::get('payments/{payment}/view', [CashierPaymentController::class, 'show'])
            ->name('payments.show');

        // Reports
        // Route::prefix('reports')->group(function () {
        //     Route::get('/payment-reports', [CashierReportController::class, 'paymentReports'])->name('reports.payment-reports');
        //     Route::get('/enrollment-summary', [CashierReportController::class, 'enrollmentSummary'])->name('reports.enrollment-summary');


        // Student search
        Route::get('/search-student', [CashierTuitionController::class, 'searchStudent'])->name('search.student');
  });
require __DIR__ . '/auth.php';