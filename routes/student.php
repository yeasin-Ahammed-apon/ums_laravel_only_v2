<?php

use Illuminate\Support\Facades\Route;


// student routes
Route::middleware(['auth', 'CheckRole:student'])->group(function () {
    Route::get('/student/dashboard',[StudentController::class,"index"])->name('student.dashboard');
});


