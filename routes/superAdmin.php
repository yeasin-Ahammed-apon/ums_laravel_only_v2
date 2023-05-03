<?php

use App\Http\Controllers\superAdmin\SuperAdminAdminController;
use App\Http\Controllers\superAdmin\SuperAdminController;
use App\Http\Controllers\superAdmin\SuperAdminTeacherController;
use Illuminate\Support\Facades\Route;


// superAdmin routes
Route::middleware(['auth', 'CheckRole:superAdmin'])->group(function () {
    Route::prefix('/superAdmin')->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, "dashboard"])->name('superAdmin.dashboard');
        // admin
        Route::get('/admin/status/{id}', [SuperAdminAdminController::class, "status"])->name('superAdmin.admin.status');
        Route::resource('/admin', SuperAdminAdminController::class)->names('superAdmin.admin');
        // teacher
        Route::get('/teacher/status/{id}', [SuperAdminTeacherController::class, "status"])->name('superAdmin.teacher.status');
        Route::resource('/teacher', SuperAdminTeacherController::class)->names('superAdmin.teacher');
    });

});

