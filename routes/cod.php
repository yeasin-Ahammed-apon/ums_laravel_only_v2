<?php

use App\Http\Controllers\cod\CodController;
use Illuminate\Support\Facades\Route;


// cod routes
Route::middleware(['auth', 'CheckRole:cod'])->group(function () {
    Route::get('/cod/dashboard',[CodController::class,"dashboard"])->name('cod.dashboard');
});


