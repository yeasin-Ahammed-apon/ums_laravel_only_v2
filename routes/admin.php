<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


// Admin routes
Route::middleware(['auth', 'CheckRole:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, "index"])->name('admin.dashboard');
});


