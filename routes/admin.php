<?php

use App\Http\Controllers\admin\AdminAccountController;
use App\Http\Controllers\admin\AdminAdmissionController;
use App\Http\Controllers\admin\AdminCodController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminHodController;
use App\Http\Controllers\admin\AdminHrController;
use App\Http\Controllers\admin\AdminLibrarianController;
use App\Http\Controllers\admin\AdminNotificationController;
use App\Http\Controllers\admin\AdminStoreManagerController;
use App\Http\Controllers\admin\AdminTeacherController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'CheckRole:admin'])->group(function () {
    Route::prefix('/admin')->group(function () {
        //admin
        Route::get('/dashboard', [AdminController::class, "dashboard"])->name('admin.dashboard');
        // admission
        Route::get('/admission/status/{id}', [AdminAdmissionController::class, "status"])->name('admin.admission.status');
        Route::resource('/admission', AdminAdmissionController::class)->names('admin.admission');
        // account
        Route::get('/account/status/{id}', [AdminAccountController::class, "status"])->name('admin.account.status');
        Route::resource('/account', AdminAccountController::class)->names('admin.account');
        // hod
        Route::get('/hod/status/{id}', [AdminHodController::class, "status"])->name('admin.hod.status');
        Route::resource('/hod', AdminHodController::class)->names('admin.hod');
        // cod
        Route::get('/cod/make/hod/{id}', [AdminCodController::class, "hod"])->name('admin.cod.hod');
        Route::get('/cod/status/{id}', [AdminCodController::class, "status"])->name('admin.cod.status');
        Route::resource('/cod', AdminCodController::class)->names('admin.cod');
        // teacher
        Route::get('/teacher/make/hod/{id}', [AdminTeacherController::class, "hod"])->name('admin.teacher.hod');
        Route::get('/teacher/make/cod/{id}', [AdminTeacherController::class, "cod"])->name('admin.teacher.cod');
        Route::get('/teacher/status/{id}', [AdminTeacherController::class, "status"])->name('admin.teacher.status');
        Route::resource('/teacher', AdminTeacherController::class)->names('admin.teacher');
        // hr
        Route::get('/hr/status/{id}', [AdminHrController::class, "status"])->name('admin.hr.status');
        Route::resource('/hr', AdminHrController::class)->names('admin.hr');
        // librarian
        Route::get('/librarian/status/{id}', [AdminLibrarianController::class, "status"])->name('admin.librarian.status');
        Route::resource('/librarian', AdminLibrarianController::class)->names('admin.librarian');
        // storeManager
        Route::get('/storeManager/status/{id}', [AdminStoreManagerController::class, "status"])->name('admin.storeManager.status');
        Route::resource('/storeManager', AdminStoreManagerController::class)->names('admin.storeManager');
        // notification user wise
        Route::get('/notification/admin', [AdminNotificationController::class, "notification_admin"])->name('admin.notification.admin');
        Route::get('/notification/hod', [AdminNotificationController::class, "notification_hod"])->name('admin.notification.hod');
        Route::get('/notification/cod', [AdminNotificationController::class, "notification_cod"])->name('admin.notification.cod');
        Route::get('/notification/teacher', [AdminNotificationController::class, "notification_teacher"])->name('admin.notification.teacher');
        Route::get('/notification/account', [AdminNotificationController::class, "notification_account"])->name('admin.notification.account');
        Route::get('/notification/admission', [AdminNotificationController::class, "notification_admission"])->name('admin.notification.admission');
    });
});


