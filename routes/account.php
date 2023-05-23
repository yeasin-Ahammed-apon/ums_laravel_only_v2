<?php

use App\Http\Controllers\account\AccountController;
use Illuminate\Support\Facades\Route;


// hod routes
Route::middleware(['auth', 'CheckRole:account'])->group(function () {
    Route::prefix('/account')->group(function () {
        Route::get('/dashboard', [AccountController::class, "dashboard"])->name('account.dashboard');
        Route::get('/profile', [AccountController::class, "profile"])->name('account.profile');
    });
});


