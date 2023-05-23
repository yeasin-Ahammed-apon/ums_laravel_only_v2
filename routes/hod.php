<?php

use App\Http\Controllers\hod\HodCodController;
use App\Http\Controllers\hod\HodController;
use App\Http\Controllers\hod\HodDepartmentController;
use App\Http\Controllers\hod\HodNotificationController;
use App\Http\Controllers\hod\HodTeacherController;
use Illuminate\Support\Facades\Route;


// hod routes
Route::middleware(['auth', 'CheckRole:hod'])->group(function () {
    Route::prefix('/hod')->group(function () {
        // assigned department

        Route::get('/department', [HodDepartmentController::class, "department"])->name('hod.department');
        Route::middleware(['HodDepartmentCheck'])->group(function () {
            Route::get('/department/{department_id}/batch/info/{batch}', [HodDepartmentController::class, "batch_info"])->name('hod.batch.info');
            Route::get('/department/{department_id}/batch/active/list', [HodDepartmentController::class, "active_list"])->name('hod.batch.active.list');
            Route::get('/department/{department_id}/batch/active/{batch}', [HodDepartmentController::class, "active_batch"])->name('hod.batch.active');
            Route::get('/department/{department_id}/batch/admission/list', [HodDepartmentController::class, "admission_list"])->name('hod.batch.admission.list');
            Route::get('/department/{department_id}/batch/completed/list', [HodDepartmentController::class, "completed_list"])->name('hod.batch.completed.list');
            Route::get('/department/{department_id}/batch/completed/{batch}', [HodDepartmentController::class, "completed_batch"])->name('hod.batch.completed');
            Route::get('/department/{department_id}/batch/create', [HodDepartmentController::class, "create"])->name('hod.batch.create');
            Route::post('/department/{department_id}/batch/store', [HodDepartmentController::class, "store"])->name('hod.batch.store');
        });
        //superAdmin
        Route::get('/dashboard', [HodController::class, "dashboard"])->name('hod.dashboard');
        Route::get('/profile', [HodController::class, "profile"])->name('hod.profile');
        //table for user type was sildebar
        // Route::resource('/sidebar', SuperAdminSidebarController::class)->names('hod.sidebar');
        //user page settings
        // Route::get('/user/page/settings/{id}', [SuperAdminPageSettingController::class, "user_page_settings"])->name('hod.page.settings');
        // Route::post('/user/page/settings', [SuperAdminPageSettingController::class, "user_page_settings_update"])->name('hod.page.settings.update');

        // cod
        Route::get('/cod/status/{id}', [HodCodController::class, "status"])->name('hod.cod.status');
        Route::resource('/cod', HodCodController::class)->names('hod.cod');
        // teacher
        Route::get('/teacher/make/cod/{id}', [HodTeacherController::class, "cod"])->name('hod.teacher.cod');
        Route::get('/teacher/status/{id}', [HodTeacherController::class, "status"])->name('hod.teacher.status');
        Route::resource('/teacher', HodTeacherController::class)->names('hod.teacher');
        // notification user wise
        Route::get('/notification/hod', [HodNotificationController::class, "notification_hod"])->name('hod.notification.hod');
        Route::get('/notification/cod', [HodNotificationController::class, "notification_cod"])->name('hod.notification.cod');
        Route::get('/notification/teacher', [HodNotificationController::class, "notification_teacher"])->name('hod.notification.teacher');
    });
});


