<?php

use App\Http\Controllers\account\AccountController;
use Illuminate\Support\Facades\Route;


// hod routes
Route::middleware(['auth', 'CheckRole:account'])->group(function () {
    Route::prefix('/account')->group(function () {
        Route::get('/dashboard', [AccountController::class, "dashboard"])->name('account.dashboard');
        Route::get('/profile', [AccountController::class, "profile"])->name('account.profile');
        Route::get('/batch/temporary/student/list', [AccountController::class, "temporary_list_student"])->name('account.batch.temporary.list.student');
        Route::get('/batch/temporary/student/{temporaryStudent}/pay/slip', [AccountController::class, "temporary_student_pay_slip"])->name('account.batch.temporary.student.pay.slip');
        Route::get('/batch/temporary/student/{temporaryStudent}/pay/edit', [AccountController::class, "temporary_student_pay_edit"])->name('account.batch.temporary.student.pay.edit');
        Route::post('/batch/temporary/student/{temporaryStudent}/pay/upadte', [AccountController::class, "temporary_student_pay_update"])->name('account.batch.temporary.student.pay.update');
    });
});


