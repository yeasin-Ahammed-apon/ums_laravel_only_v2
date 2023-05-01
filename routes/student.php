<?php

use App\Http\Controllers\student\StudentController;
use Illuminate\Support\Facades\Route;


// student routes
Route::middleware(['auth', 'CheckRole:student'])->group(function () {
    Route::get('/student/dashboard',[StudentController::class,"dashboard"])->name('student.dashboard');
});


