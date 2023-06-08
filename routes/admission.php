<?php

use App\Http\Controllers\admission\AdmissionBatchController as Batch;
use App\Http\Controllers\admission\AdmissionController;
use App\Http\Controllers\admission\AdmissionStudentController;
use App\Http\Controllers\admission\AdmissionTemporaryStudentController as Temporary;
use Illuminate\Support\Facades\Route;


// hod routes
Route::middleware(['auth', 'CheckRole:admission'])->group(function () {
    Route::prefix('/admission')->group(function () {
        Route::get('/dashboard', [AdmissionController::class, "dashboard"])->name('admission.dashboard');
        Route::get('/profile', [AdmissionController::class, "profile"])->name('admission.profile');

        // Temporary to Parmanent stundet
        Route::get('/student/create/{temporaryStudent}', [AdmissionStudentController::class, "create"])->name('admission.student.create');

        // Temporary
        Route::get('/student/temporaryStudent/history', [Temporary::class, "history"])->name('admission.temporaryStudent.history');
        Route::get('/student/temporaryStudent/list', [Temporary::class, "list"])->name('admission.temporaryStudent.list');
        Route::get('/student/{temporaryStudent}/show', [Temporary::class, "show"])->name('admission.temporaryStudent.show');
        Route::get('/student/{batch}/temporaryStudent/create', [Temporary::class, "create"])->name('admission.temporaryStudent.create');
        Route::post('/student/{batch}/temporaryStudent/store', [Temporary::class, "store"])->name('admission.temporaryStudent.store');
        Route::get('/student/{temporaryStudent}/print', [Temporary::class, "print"])->name('admission.temporaryStudent.print');

        Route::get('/batch/list', [Batch::class, "list"])->name('admission.batch.list');
        Route::get('/{batch}/show', [Batch::class, "show"])->name('admission.batch.show');
    });
});


