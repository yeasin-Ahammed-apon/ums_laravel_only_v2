<?php

use App\Http\Controllers\superAdmin\SuperAdminAccountController;
use App\Http\Controllers\superAdmin\SuperAdminAdminController;
use App\Http\Controllers\superAdmin\SuperAdminAdmissionController;
use App\Http\Controllers\superAdmin\SuperAdminCodController;
use App\Http\Controllers\superAdmin\SuperAdminController;
use App\Http\Controllers\superAdmin\SuperAdminHodController;
use App\Http\Controllers\superAdmin\SuperAdminNotificationController;
use App\Http\Controllers\superAdmin\SuperAdminPageSettingController;
use App\Http\Controllers\superAdmin\SuperAdminSidebarController;
use App\Http\Controllers\superAdmin\SuperAdminTeacherController;
use Illuminate\Support\Facades\Route;


// superAdmin routes
Route::middleware(['auth', 'CheckRole:superAdmin'])->group(function () {
    Route::prefix('/superAdmin')->group(function () {
        //superAdmin
        Route::get('/dashboard', [SuperAdminController::class, "dashboard"])->name('superAdmin.dashboard');
        //table for user type was sildebar
        Route::resource('/sidebar', SuperAdminSidebarController::class)->names('superAdmin.sidebar');
        //user page setting
        Route::get('/user/page/settings/{id}', [SuperAdminPageSettingController::class, "user_page_settings"])->name('superAdmin.page.settings');
        Route::post('/user/page/settings', [SuperAdminPageSettingController::class, "user_page_settings_update"])->name('superAdmin.page.settings.update');
        // admin
        Route::get('/admin/status/{id}', [SuperAdminAdminController::class, "status"])->name('superAdmin.admin.status');
        Route::resource('/admin', SuperAdminAdminController::class)->names('superAdmin.admin');
        // admission
        Route::get('/admission/status/{id}', [SuperAdminAdmissionController::class, "status"])->name('superAdmin.admission.status');
        Route::resource('/admission', SuperAdminAdmissionController::class)->names('superAdmin.admission');
        // account
        Route::get('/account/status/{id}', [SuperAdminAccountController::class, "status"])->name('superAdmin.account.status');
        Route::resource('/account', SuperAdminAccountController::class)->names('superAdmin.account');
        // hod
        Route::get('/hod/status/{id}', [SuperAdminHodController::class, "status"])->name('superAdmin.hod.status');
        Route::resource('/hod', SuperAdminHodController::class)->names('superAdmin.hod');
        // cod
        Route::get('/cod/make/hod/{id}', [SuperAdminCodController::class, "hod"])->name('superAdmin.cod.hod');
        Route::get('/cod/status/{id}', [SuperAdminCodController::class, "status"])->name('superAdmin.cod.status');
        Route::resource('/cod', SuperAdminCodController::class)->names('superAdmin.cod');
        // teacher
        Route::get('/teacher/make/hod/{id}', [SuperAdminTeacherController::class, "hod"])->name('superAdmin.teacher.hod');
        Route::get('/teacher/make/cod/{id}', [SuperAdminTeacherController::class, "cod"])->name('superAdmin.teacher.cod');
        Route::get('/teacher/status/{id}', [SuperAdminTeacherController::class, "status"])->name('superAdmin.teacher.status');
        Route::resource('/teacher', SuperAdminTeacherController::class)->names('superAdmin.teacher');
        // notification user wise
        Route::get('/notification/superAdmin', [SuperAdminNotificationController::class, "notification_superAdmin"])->name('superAdmin.notification.superAdmin');
        Route::get('/notification/admin', [SuperAdminNotificationController::class, "notification_admin"])->name('superAdmin.notification.admin');
        Route::get('/notification/hod', [SuperAdminNotificationController::class, "notification_hod"])->name('superAdmin.notification.hod');
        Route::get('/notification/cod', [SuperAdminNotificationController::class, "notification_cod"])->name('superAdmin.notification.cod');
        Route::get('/notification/teacher', [SuperAdminNotificationController::class, "notification_teacher"])->name('superAdmin.notification.teacher');
        Route::get('/notification/account', [SuperAdminNotificationController::class, "notification_account"])->name('superAdmin.notification.account');
        Route::get('/notification/admission', [SuperAdminNotificationController::class, "notification_admission"])->name('superAdmin.notification.admission');
    });
});
