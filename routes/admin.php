<?php

use App\Http\Controllers\userManagement\AccountController;
use App\Http\Controllers\userManagement\AdmissionController;
use App\Http\Controllers\userManagement\CodController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\userManagement\HodController;
use App\Http\Controllers\userManagement\HrController;
use App\Http\Controllers\userManagement\LibrarianController;
use App\Http\Controllers\admin\AdminNotificationController as NotificationController;
use App\Http\Controllers\userManagement\StoreManagerController;
use App\Http\Controllers\userManagement\TeacherController;
use Illuminate\Support\Facades\Route;
/**
 * [Note]
 * few controller name was shorten.
 * */


Route::middleware(['auth', 'CheckRole:admin'])->group(function () {
    Route::prefix('/admin')->group(function () {
        //admin
        Route::get('/dashboard', [AdminController::class, "dashboard"])->name('admin.dashboard');
        // admission
        Route::get('/admission/status/{id}', [AdmissionController::class, "status"])->name('admin.admission.status');
        Route::resource('/admission', AdmissionController::class)->names('admin.admission');
        // account
        Route::get('/account/status/{id}', [AccountController::class, "status"])->name('admin.account.status');
        Route::resource('/account', AccountController::class)->names('admin.account');
        // hod
        Route::get('/hod/status/{id}', [HodController::class, "status"])->name('admin.hod.status');
        Route::resource('/hod', HodController::class)->names('admin.hod');
        // cod
        Route::get('/cod/make/hod/{id}', [CodController::class, "hod"])->name('admin.cod.hod');
        Route::get('/cod/status/{id}', [CodController::class, "status"])->name('admin.cod.status');
        Route::resource('/cod', CodController::class)->names('admin.cod');
        // teacher
        Route::get('/teacher/make/hod/{id}', [TeacherController::class, "hod"])->name('admin.teacher.hod');
        Route::get('/teacher/make/cod/{id}', [TeacherController::class, "cod"])->name('admin.teacher.cod');
        Route::get('/teacher/status/{id}', [TeacherController::class, "status"])->name('admin.teacher.status');
        Route::resource('/teacher', TeacherController::class)->names('admin.teacher');
        // hr
        Route::get('/hr/status/{id}', [HrController::class, "status"])->name('admin.hr.status');
        Route::resource('/hr', HrController::class)->names('admin.hr');
        // librarian
        Route::get('/librarian/status/{id}', [LibrarianController::class, "status"])->name('admin.librarian.status');
        Route::resource('/librarian', LibrarianController::class)->names('admin.librarian');
        // storeManager
        Route::get('/storeManager/status/{id}', [StoreManagerController::class, "status"])->name('admin.storeManager.status');
        Route::resource('/storeManager', StoreManagerController::class)->names('admin.storeManager');
        // notification user wise
        Route::get('/notification/admin', [NotificationController::class, "notification_admin"])->name('admin.notification.admin');
        Route::get('/notification/hod', [NotificationController::class, "notification_hod"])->name('admin.notification.hod');
        Route::get('/notification/cod', [NotificationController::class, "notification_cod"])->name('admin.notification.cod');
        Route::get('/notification/teacher', [NotificationController::class, "notification_teacher"])->name('admin.notification.teacher');
        Route::get('/notification/account', [NotificationController::class, "notification_account"])->name('admin.notification.account');
        Route::get('/notification/admission', [NotificationController::class, "notification_admission"])->name('admin.notification.admission');
    });
});


