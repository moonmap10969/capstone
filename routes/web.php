<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Helpers\AESHelper;
// Auth controllers
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

// Public controllers
use App\Http\Controllers\AdmissionController;

// Admin controllers
use App\Http\Controllers\Admin\{
    UserController,
    AcademicYearController,
    AdminScheduleController,
    DashboardController,
    ReportController,
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
        Route::get('/documents', [DocumentController::class, 'index'])
        ->name('documents.index');
         Route::get('/documents/download/{column}', [DocumentController::class, 'download'])
        ->name('documents.download');

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
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');
        Route::get('/analytics', [App\Http\Controllers\Admin\DashboardController::class, 'analytics'])->name('analytics');
        
        Route::resources([
            'users' => UserController::class,
            'documents' => AdminDocumentController::class,
            'tuitions' => AdminTuitionController::class,
            'schedule' => AdminScheduleController::class,
            'sections' => AdminSectionsController::class,
        ]);
        
        Route::get('/academic-years', [AcademicYearController::class, 'index'])->name('ay.index');
        Route::post('/academic-years', [AcademicYearController::class, 'store'])->name('ay.store');
        Route::post('/academic-year/{id}/set', [AcademicYearController::class, 'setCurrent'])->name('ay.set');

        Route::get('/socioeconomics', [DashboardController::class, 'economics'])->name('economics');
        Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports');
        Route::get('/reports/export', [App\Http\Controllers\Admin\ReportController::class, 'exportCsv'])->name('reports.export');
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
            
            Route::get('enrollment/retention', [EnrollmentController::class, 'retentionAnalytics'])->name('enrollment.retention');
            Route::post('enrollment/send-alerts', [EnrollmentController::class, 'sendBurstAlerts'])->name('enrollment.send_alerts');
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
| Cashier Routes (Restricted)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:cashier'])
    ->prefix('cashier')
    ->name('cashier.')
    ->group(function () {
        Route::get('/', [CashierDashboardController::class, 'index'])->name('index');
        Route::resource('students', CashierStudentController::class)->only(['index', 'show']);
        Route::get('enrollment', [EnrollmentController::class, 'index'])->name('enrollment');

        // Tuitions
        Route::resource('tuitions', CashierTuitionController::class);
        Route::patch('tuitions/{tuition}/approve', [CashierTuitionController::class, 'approve'])->name('tuitions.approve');
        Route::patch('tuitions/{tuition}/reject', [CashierTuitionController::class, 'reject'])->name('tuitions.reject');
        Route::patch('tuitions/{tuition}/set-payment', [CashierTuitionController::class, 'setPayment'])->name('tuitions.setPayment');
        Route::get('/search-student', [CashierTuitionController::class, 'searchStudent'])->name('search.student');

        // Payments Group
        Route::prefix('payments')->name('payments.')->group(function () {
            Route::get('/', [CashierPaymentController::class, 'index'])->name('index');
            Route::get('/create', [CashierPaymentController::class, 'create'])->name('create');
            Route::post('/', [CashierPaymentController::class, 'store'])->name('store');
            Route::get('/{id}/show', [CashierPaymentController::class, 'show'])->name('show');
            Route::get('/{id}/download', [CashierPaymentController::class, 'download'])->name('download');
            Route::post('/{id}/approve-online', [CashierPaymentController::class, 'approveOnline'])->name('approveOnline');
            Route::post('/{id}/reject', [CashierPaymentController::class, 'reject'])->name('reject');
        }); 
    });

/*
|--------------------------------------------------------------------------
| Shared Routes (Accessible by Students & Cashiers)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/view-payment-receipt/{filename}', function ($filename) {
        // Look for the record in receipt_path as requested
        $payment = \App\Models\Payment::where('receipt_path', 'LIKE', '%' . $filename)->firstOrFail();

        // Student Security Check
        if (Auth::user()->role === 'student') {
            $student = \App\Models\Admission::where('user_id', Auth::id())->first();
            if (!$student || $payment->studentNumber !== $student->studentNumber) {
                abort(403, "Unauthorized: This is not your receipt.");
            }
        }

        $path = 'receipts/' . $filename;
        
        if (!Storage::disk('local')->exists($path)) {
            abort(404, "File not found in storage/app/receipts/");
        }

        // Determine MimeType manually to avoid "undefined" errors
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $mimes = [
            'png'  => 'image/png',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'pdf'  => 'application/pdf'
        ];
        $mimeType = $mimes[$extension] ?? 'image/jpeg';

        $scrambledData = Storage::disk('local')->get($path);
        $cleanData = AESHelper::decrypt($scrambledData);

        return response($cleanData, 200)->header('Content-Type', $mimeType);
    })->where('filename', '.*')->name('payments.receipt.view');
});

require __DIR__ . '/auth.php';