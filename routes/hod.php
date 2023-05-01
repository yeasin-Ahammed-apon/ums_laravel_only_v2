<?php

use App\Http\Controllers\hod\HodController;
use Illuminate\Support\Facades\Route;


// hod routes
Route::middleware(['auth', 'CheckRole:hod'])->group(function () {
    Route::get('/hod/dashboard',[HodController::class,"dashboard"])->name('hod.dashboard');
});


