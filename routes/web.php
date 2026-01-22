<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\AdmissionController as AdminAdmissionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TuitionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Student\AdmissionController as StudentAdmissionController;
use App\Http\Controllers\Auth\PasswordChangeController;
use App\Models\Tuition;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'))->name('home');
Route::get('/about', fn () => view('about'))->name('about');
Route::get('/education', fn () => view('education'))->name('education');
Route::get('/admissions', fn () => view('admissions'))->name('admissions');

// Public Guest Admission Form
Route::get('/apply', [StudentAdmissionController::class, 'create'])->name('admissions.apply');
Route::post('/apply', [StudentAdmissionController::class, 'store'])->name('student.admissions.store');
Route::get('/success', function () {
    return view('success-card'); // Ensure this path matches your file location
})->name('success-card');

/*
|--------------------------------------------------------------------------
| Student Routes (Requires Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // 1. Password change MUST be outside 'check.password' to avoid loops
    Route::get('/change-password', [PasswordChangeController::class, 'show'])->name('password.change');
    Route::post('/change-password', [PasswordChangeController::class, 'update'])->name('password.update');

    // 2. Protected Student Routes
    Route::middleware(['check.password'])->group(function () {
        
        Route::get('/student-index', [StudentAdmissionController::class, 'index'])->name('student.index');
        Route::get('/my-admission', [StudentAdmissionController::class, 'index'])->name('student.admissions.index');
        Route::get('/documents', [StudentAdmissionController::class, 'documents'])->name('student.documents.index');

    // Tuition & Payments
    Route::get('/student/tuition', function () {
        $user = Auth::user();
        $student = $user->student;
        $tuitionRecord = $student ? Tuition::where('student_number', $student->student_number)->first() : null;
        
        $totalTuition = $tuitionRecord->total_amount ?? 0;
        $totalPaid = $tuitionRecord->paid_amount ?? 0;
        $remainingBalance = $totalTuition - $totalPaid;
        $percentagePaid = ($totalTuition > 0) ? ($totalPaid / $totalTuition) * 100 : 0;
        $payments = $student ? ($student->payments ?? collect([])) : collect([]);
        
        return view('student.tuition.index', compact('totalTuition', 'totalPaid', 'remainingBalance', 'percentagePaid', 'payments'));
    })->name('student.tuitions.index')->middleware(['auth']);

        Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');
        Route::get('/reports', fn () => view('student.reports'))->name('reports.index');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Requires Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminAdmissionController::class, 'index'])->name('index');
    
    Route::resource('users', UserController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('admissions', AdminAdmissionController::class)->only(['index', 'show', 'destroy', 'create', 'store']);
    Route::resource('tuitions', TuitionController::class);
    Route::resource('reports', ReportController::class);

    // Patch Routes
    Route::patch('documents/{document}/approve', [DocumentController::class, 'approve'])->name('documents.approve');
    Route::patch('documents/{document}/reject', [DocumentController::class, 'reject'])->name('documents.reject');
    Route::patch('tuitions/{tuition}/approve', [TuitionController::class, 'approve'])->name('tuitions.approve');
    Route::patch('tuitions/{tuition}/reject', [TuitionController::class, 'reject'])->name('tuitions.reject');
    Route::patch('admissions/{admission}/approve', [AdminAdmissionController::class, 'approve'])->name('admissions.approve');
    Route::patch('admissions/{admission}/reject', [AdminAdmissionController::class, 'reject'])->name('admissions.reject');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

require __DIR__ . '/auth.php';