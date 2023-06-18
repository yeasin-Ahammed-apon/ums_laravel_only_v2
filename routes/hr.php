<?php

use App\Http\Controllers\hr\HrAccountController;
use App\Http\Controllers\hr\HrAdmissionController;
use App\Http\Controllers\hr\HrCodController;
use App\Http\Controllers\hr\HrController;
use App\Http\Controllers\hr\HrHodController;
use App\Http\Controllers\hr\HrHrController;
use App\Http\Controllers\hr\HrLibrarianController;
use App\Http\Controllers\hr\HrStoreManagerController;
use App\Http\Controllers\hr\HrTeacherController;
use Illuminate\Support\Facades\Route;


// superAdmin routes
Route::middleware(['auth', 'CheckRole:hr'])->group(function () {
    Route::prefix('/hr')->group(function () {
        //superAdmin
        Route::get('/dashboard', [HrController::class, "dashboard"])->name('hr.dashboard');
        Route::get('/profile', [HrController::class, "profile"])->name('hr.profile');
        // admission
        Route::get('/admission/status/{id}', [HrAdmissionController::class, "status"])->name('hr.admission.status');
        Route::resource('/admission', HrAdmissionController::class)->names('hr.admission');
        // account
        Route::get('/account/status/{id}', [HrAccountController::class, "status"])->name('hr.account.status');
        Route::resource('/account', HrAccountController::class)->names('hr.account');
        // hod
        Route::get('/hod/status/{id}', [HrHodController::class, "status"])->name('hr.hod.status');
        Route::resource('/hod', HrHodController::class)->names('hr.hod');
        // cod
        Route::get('/cod/make/hod/{id}', [HrCodController::class, "hod"])->name('hr.cod.hod');
        Route::get('/cod/status/{id}', [HrCodController::class, "status"])->name('hr.cod.status');
        Route::resource('/cod', HrCodController::class)->names('hr.cod');
        // teacher
        Route::get('/teacher/make/hod/{id}', [HrTeacherController::class, "hod"])->name('hr.teacher.hod');
        Route::get('/teacher/make/cod/{id}', [HrTeacherController::class, "cod"])->name('hr.teacher.cod');
        Route::get('/teacher/status/{id}', [HrTeacherController::class, "status"])->name('hr.teacher.status');
        Route::resource('/teacher', HrTeacherController::class)->names('hr.teacher');
        // hr
        Route::get('/hr/status/{id}', [HrHrController::class, "status"])->name('hr.hr.status');
        Route::resource('/hr', HrHrController::class)->names('hr.hr');
        // librarian
        Route::get('/librarian/status/{id}', [HrLibrarianController::class, "status"])->name('hr.librarian.status');
        Route::resource('/librarian', HrLibrarianController::class)->names('hr.librarian');
        // storeManager
        Route::get('/storeManager/status/{id}', [HrStoreManagerController::class, "status"])->name('hr.storeManager.status');
        Route::resource('/storeManager', HrStoreManagerController::class)->names('hr.storeManager');
    });
});
