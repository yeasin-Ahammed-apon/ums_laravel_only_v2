<?php

use App\Http\Controllers\admission\AdmissionController;
use Illuminate\Support\Facades\Route;


// hod routes
Route::middleware(['auth', 'CheckRole:admission'])->group(function () {
    Route::prefix('/admission')->group(function () {
        Route::get('/dashboard', [AdmissionController::class, "dashboard"])->name('admission.dashboard');
        Route::get('/profile', [AdmissionController::class, "profile"])->name('admission.profile');
        Route::get('/batch/admission/open/list', [AdmissionController::class, "admission_open_list"])->name('admission.batch.open.list');
        Route::get('/batch/temporary/student/list', [AdmissionController::class, "temporary_list_student"])->name('admission.batch.temporary.list.student');
        Route::get('/batch/temporary/student/{temporaryStudent}/view', [AdmissionController::class, "temporary_student_view"])->name('admission.batch.temporary.view.student');
        Route::get('/batch/temporary/student/{temporaryStudent}/view/print', [AdmissionController::class, "temporary_student_view_print"])->name('admission.batch.temporary.view.student.print');
        Route::get('/batch/{batch}/info', [AdmissionController::class, "batch_info"])->name('admission.batch.info');
        Route::get('/batch/{batch}/temporary/student/add', [AdmissionController::class, "temporary_add_student"])->name('admission.batch.temporary.add.student');
        Route::post('/batch/{batch}/temporary/student/store', [AdmissionController::class, "temporary_store_student"])->name('admission.batch.temporary.store.student');

    });
});


