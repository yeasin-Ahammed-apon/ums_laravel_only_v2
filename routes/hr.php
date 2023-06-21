<?php

use App\Http\Controllers\userManagement\AccountController;
use App\Http\Controllers\userManagement\AdmissionController;
use App\Http\Controllers\userManagement\CodController;
use App\Http\Controllers\hr\HrController as Hr;
use App\Http\Controllers\userManagement\HodController;
use App\Http\Controllers\userManagement\HrController;
use App\Http\Controllers\userManagement\LibrarianController;
use App\Http\Controllers\userManagement\StoreManagerController;
use App\Http\Controllers\userManagement\TeacherController;
use Illuminate\Support\Facades\Route;

/**
 * [Note]
 * few controller name was shorten.
 * */

// superAdmin routes
Route::middleware(['auth', 'CheckRole:hr'])->group(function () {
    Route::prefix('/hr')->group(function () {
        //superAdmin
        Route::get('/dashboard', [Hr::class, "dashboard"])->name('hr.dashboard');
        Route::get('/profile', [Hr::class, "profile"])->name('hr.profile');
        // admission
        Route::get('/admission/status/{id}', [AdmissionController::class, "status"])->name('hr.admission.status');
        Route::resource('/admission', AdmissionController::class)->names('hr.admission');
        // account
        Route::get('/account/status/{id}', [AccountController::class, "status"])->name('hr.account.status');
        Route::resource('/account', AccountController::class)->names('hr.account');
        // hod
        Route::get('/hod/status/{id}', [HodController::class, "status"])->name('hr.hod.status');
        Route::resource('/hod', HodController::class)->names('hr.hod');
        // cod
        Route::get('/cod/make/hod/{id}', [CodController::class, "hod"])->name('hr.cod.hod');
        Route::get('/cod/status/{id}', [CodController::class, "status"])->name('hr.cod.status');
        Route::resource('/cod', CodController::class)->names('hr.cod');
        // teacher
        Route::get('/teacher/make/hod/{id}', [TeacherController::class, "hod"])->name('hr.teacher.hod');
        Route::get('/teacher/make/cod/{id}', [TeacherController::class, "cod"])->name('hr.teacher.cod');
        Route::get('/teacher/status/{id}', [TeacherController::class, "status"])->name('hr.teacher.status');
        Route::resource('/teacher', TeacherController::class)->names('hr.teacher');
        // hr
        Route::get('/hr/status/{id}', [HrController::class, "status"])->name('hr.hr.status');
        Route::resource('/hr', HrController::class)->names('hr.hr');
        // librarian
        Route::get('/librarian/status/{id}', [LibrarianController::class, "status"])->name('hr.librarian.status');
        Route::resource('/librarian', LibrarianController::class)->names('hr.librarian');
        // storeManager
        Route::get('/storeManager/status/{id}', [StoreManagerController::class, "status"])->name('hr.storeManager.status');
        Route::resource('/storeManager', StoreManagerController::class)->names('hr.storeManager');
    });
});
