<?php

use App\Http\Controllers\admission\AdmissionController;
use Illuminate\Support\Facades\Route;


// hod routes
Route::middleware(['auth', 'CheckRole:admission'])->group(function () {
    Route::prefix('/admission')->group(function () {
        Route::get('/dashboard', [AdmissionController::class, "dashboard"])->name('admission.dashboard');
        Route::get('/profile', [AdmissionController::class, "profile"])->name('admission.profile');
        Route::get('/batch/{batch}/info', [AdmissionController::class, "batch_info"])->name('admission.batch.info');
        Route::get('/batch/{batch}/temporary/add/student', [AdmissionController::class, "temporary_add_student"])->name('admission.batch.temporary.add.student');
        Route::post('/batch/{batch}/temporary/store/student', [AdmissionController::class, "temporary_store_student"])->name('admission.batch.temporary.store.student');
        Route::get('/batch/{batch}/temporary/{temporaryStudent}/student', [AdmissionController::class, "temporary_student"])->name('admission.batch.temporary.student');

    });
});


