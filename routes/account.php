<?php

use App\Http\Controllers\account\AccountController;
use App\Http\Controllers\account\AccountTemporaryStudentController as Temporary;
use Illuminate\Support\Facades\Route;


// hod routes
Route::middleware(['auth', 'CheckRole:account'])->group(function () {
    Route::prefix('/account')->group(function () {

        Route::get('/dashboard', [AccountController::class, "dashboard"])->name('account.dashboard');
        Route::get('/profile', [AccountController::class, "profile"])->name('account.profile');

        Route::get('/temporary/list', [Temporary::class, "list"])->name('account.temporary.payment.list');
        Route::get('/temporary/{temporaryStudent}/payment/edit', [Temporary::class, "edit"])->name('account.temporary.payment.edit');
        Route::post('/temporary/{temporaryStudent}/payment/upadte', [Temporary::class, "update"])->name('account.temporary.payment.update');
        Route::get('/temporary/{temporaryStudent}/payment/print', [Temporary::class, "print"])->name('account.temporary.payment.print');

    });
});


