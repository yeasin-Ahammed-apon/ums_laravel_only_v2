<?php

use App\Http\Controllers\superAdmin\SuperAdminAdminController;
use App\Http\Controllers\superAdmin\SuperAdminController;
use App\Http\Controllers\superAdmin\SuperAdminTeacherController;
use Illuminate\Support\Facades\Route;


// superAdmin routes
Route::middleware(['auth', 'CheckRole:superAdmin'])->group(function () {
    Route::get('/superAdmin/dashboard',[SuperAdminController::class,"dashboard"])->name('superAdmin.dashboard');
    // admin
    Route::resource('/superAdmin/admin', SuperAdminAdminController::class)->names('superAdmin.admin');
    // teacher
    Route::resource('/superAdmin/teacher', SuperAdminTeacherController::class)->names('superAdmin.teacher');

});

