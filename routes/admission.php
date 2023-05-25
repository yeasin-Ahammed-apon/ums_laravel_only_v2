<?php

use App\Http\Controllers\admission\AdmissionController;
use Illuminate\Support\Facades\Route;


// hod routes
Route::middleware(['auth', 'CheckRole:admission'])->group(function () {
    Route::prefix('/admission')->group(function () {
        Route::get('/dashboard', [AdmissionController::class, "dashboard"])->name('admission.dashboard');
        Route::get('/profile', [AdmissionController::class, "profile"])->name('admission.profile');
        Route::get('/batch/{batch}/info', [AdmissionController::class, "batch_info"])->name('admission.batch.info');
    });
});


