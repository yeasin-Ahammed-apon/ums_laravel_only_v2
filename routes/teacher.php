<?php

use Illuminate\Support\Facades\Route;


// teacher routes
Route::middleware(['auth', 'CheckRole:teacher'])->group(function () {
    Route::get('/teacher/dashboard',[StudentController::class,"index"])->name('teacher.dashboard');
});


