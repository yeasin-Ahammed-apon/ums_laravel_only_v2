<?php

use App\Http\Controllers\hod\HodController;
use Illuminate\Support\Facades\Route;


// hod routes
Route::middleware(['auth', 'CheckRole:hod'])->group(function () {
    Route::prefix('/hod')->group(function () {
        //superAdmin
        Route::get('/dashboard', [HodController::class, "dashboard"])->name('hod.dashboard');
        Route::get('/profile', [SuperAdminController::class, "profile"])->name('hod.profile');
        //table for user type was sildebar
        Route::resource('/sidebar', SuperAdminSidebarController::class)->names('hod.sidebar');
        //user page settings
        Route::get('/user/page/settings/{id}', [SuperAdminPageSettingController::class, "user_page_settings"])->name('hod.page.settings');
        Route::post('/user/page/settings', [SuperAdminPageSettingController::class, "user_page_settings_update"])->name('hod.page.settings.update');
        // admin
        Route::get('/admin/status/{id}', [SuperAdminAdminController::class, "status"])->name('hod.admin.status');
        Route::get('/admin/trash', [SuperAdminAdminController::class, "trash"])->name('hod.admin.trash');
        Route::get('/admin/restore/{id}', [SuperAdminAdminController::class, "restore"])->name('hod.admin.restore');
        Route::get('/admin/forcedelete/{id}', [SuperAdminAdminController::class, "forcedelete"])->name('hod.admin.forcedelete');
        Route::resource('/admin', SuperAdminAdminController::class)->names('hod.admin');
        // admission
        Route::get('/admission/status/{id}', [SuperAdminAdmissionController::class, "status"])->name('hod.admission.status');
        Route::resource('/admission', SuperAdminAdmissionController::class)->names('hod.admission');
        // account
        Route::get('/account/status/{id}', [SuperAdminAccountController::class, "status"])->name('hod.account.status');
        Route::resource('/account', SuperAdminAccountController::class)->names('hod.account');
        // hod
        Route::get('/hod/status/{id}', [SuperAdminHodController::class, "status"])->name('hod.hod.status');
        Route::resource('/hod', SuperAdminHodController::class)->names('hod.hod');
        // cod
        Route::get('/cod/make/hod/{id}', [SuperAdminCodController::class, "hod"])->name('hod.cod.hod');
        Route::get('/cod/status/{id}', [SuperAdminCodController::class, "status"])->name('hod.cod.status');
        Route::resource('/cod', SuperAdminCodController::class)->names('hod.cod');
        // teacher
        Route::get('/teacher/make/hod/{id}', [SuperAdminTeacherController::class, "hod"])->name('hod.teacher.hod');
        Route::get('/teacher/make/cod/{id}', [SuperAdminTeacherController::class, "cod"])->name('hod.teacher.cod');
        Route::get('/teacher/status/{id}', [SuperAdminTeacherController::class, "status"])->name('hod.teacher.status');
        Route::resource('/teacher', SuperAdminTeacherController::class)->names('hod.teacher');
        // notification user wise
        Route::get('/notification/superAdmin', [SuperAdminNotificationController::class, "notification_superAdmin"])->name('hod.notification.superAdmin');
        Route::get('/notification/admin', [SuperAdminNotificationController::class, "notification_admin"])->name('hod.notification.admin');
        Route::get('/notification/hod', [SuperAdminNotificationController::class, "notification_hod"])->name('hod.notification.hod');
        Route::get('/notification/cod', [SuperAdminNotificationController::class, "notification_cod"])->name('hod.notification.cod');
        Route::get('/notification/teacher', [SuperAdminNotificationController::class, "notification_teacher"])->name('hod.notification.teacher');
        Route::get('/notification/account', [SuperAdminNotificationController::class, "notification_account"])->name('hod.notification.account');
        Route::get('/notification/admission', [SuperAdminNotificationController::class, "notification_admission"])->name('hod.notification.admission');
    });
});


