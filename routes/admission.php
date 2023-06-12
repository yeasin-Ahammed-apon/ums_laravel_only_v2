<?php

use App\Http\Controllers\admission\AdmissionBatchController as Batch;
use App\Http\Controllers\admission\AdmissionController As Admission;
use App\Http\Controllers\admission\AdmissionStudentController As Student;
use App\Http\Controllers\admission\AdmissionTemporaryStudentController as Temporary;
use Illuminate\Support\Facades\Route;


// hod routes
Route::middleware(['auth', 'CheckRole:admission'])->group(function () {
    Route::prefix('/admission')->group(function () {
        Route::get('/dashboard', [Admission::class, "dashboard"])->name('admission.dashboard');
        Route::get('/profile', [Admission::class, "profile"])->name('admission.profile');

        // Temporary to Parmanent stundet
        Route::get('/student/list', [Student::class, "list"])->name('admission.student.list');
        Route::get('/student/create/{temporaryStudent}', [Student::class, "create"])->name('admission.student.create');
        Route::post('/student/store/{temporaryStudent}', [Student::class, "store"])->name('admission.student.store');
        Route::get('/student/education/create/{user}', [Student::class, "education_create"])->name('admission.student.education_create');
        Route::post('/student/education/store/{user}', [Student::class, "education_store"])->name('admission.student.education_store');

        // Temporary
        Route::get('/student/temporaryStudent/history', [Temporary::class, "history"])->name('admission.temporaryStudent.history');
        Route::get('/student/temporaryStudent/list', [Temporary::class, "list"])->name('admission.temporaryStudent.list');
        Route::get('/student/{temporaryStudent}/show', [Temporary::class, "show"])->name('admission.temporaryStudent.show');
        Route::get('/student/{batch}/temporaryStudent/create', [Temporary::class, "create"])->name('admission.temporaryStudent.create');
        Route::post('/student/{batch}/temporaryStudent/store', [Temporary::class, "store"])->name('admission.temporaryStudent.store');
        Route::get('/student/{temporaryStudent}/print', [Temporary::class, "print"])->name('admission.temporaryStudent.print');

        //batch data
        Route::get('/batch/list', [Batch::class, "list"])->name('admission.batch.list');
        Route::get('/{batch}/show', [Batch::class, "show"])->name('admission.batch.show');
    });
});


