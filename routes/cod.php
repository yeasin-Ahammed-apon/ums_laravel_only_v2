<?php

use Illuminate\Support\Facades\Route;


// cod routes
Route::middleware(['auth', 'CheckRole:cod'])->group(function () {
    Route::get('/cod/dashboard',[StudentController::class,"index"])->name('cod.dashboard');
});


