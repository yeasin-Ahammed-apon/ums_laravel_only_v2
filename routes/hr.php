<?php

use App\Http\Controllers\hr\HrController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'CheckRole:hr'])->group(function () {
    Route::prefix('/hr')->group(function () {
        //superAdmin
        Route::get('/dashboard', [HrController::class, "dashboard"])->name('hr.dashboard');
    });
});


