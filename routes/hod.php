<?php

use Illuminate\Support\Facades\Route;


// hod routes
Route::middleware(['auth', 'CheckRole:hod'])->group(function () {
    Route::get('/hod/dashboard',[StudentController::class,"index"])->name('hod.dashboard');
});


