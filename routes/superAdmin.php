<?php

use App\Http\Controllers\superAdmin\SuperAdminAdminController;
use App\Http\Controllers\superAdmin\SuperAdminCodController;
use App\Http\Controllers\superAdmin\SuperAdminController;
use App\Http\Controllers\superAdmin\SuperAdminHodController;
use App\Http\Controllers\superAdmin\SuperAdminTeacherController;
use Illuminate\Support\Facades\Route;


// superAdmin routes
Route::middleware(['auth', 'CheckRole:superAdmin'])->group(function () {
    Route::prefix('/superAdmin')->group(function () {

        Route::get('/dashboard', [SuperAdminController::class, "dashboard"])->name('superAdmin.dashboard');
        Route::get('/notification/superAdmin', [SuperAdminController::class, "notification_superAdmin"])->name('superAdmin.notification.superAdmin');
        Route::get('/notification/admin', [SuperAdminController::class, "notification_admin"])->name('superAdmin.notification.admin');
        Route::get('/notification/hod', [SuperAdminController::class, "notification_hod"])->name('superAdmin.notification.hod');
        Route::get('/notification/cod', [SuperAdminController::class, "notification_cod"])->name('superAdmin.notification.cod');
        Route::get('/notification/teacher', [SuperAdminController::class, "notification_teacher"])->name('superAdmin.notification.teacher');
        // admin
            Route::get('/admin/status/{id}', [SuperAdminAdminController::class, "status"])->name('superAdmin.admin.status');
            Route::resource('/admin', SuperAdminAdminController::class)->names('superAdmin.admin');
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
    });

});

