<?php

use App\Http\Controllers\teacher\TeacherController;
use Illuminate\Support\Facades\Route;


// teacher routes
Route::middleware(['auth', 'CheckRole:teacher'])->group(function () {
    Route::get('/teacher/dashboard',[TeacherController::class,"dashboard"])->name('teacher.dashboard');
});


