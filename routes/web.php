<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeparmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// there is also superAdmin,admin,hod,cod,account,admission.php for there respectful role wise

Route::get('/',function (){
    return redirect()->route('login');
})->name('home');
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'authenticate'])->name('authenticate');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

// multiple user check (superAdmin and admin)
Route::middleware(['auth', 'CheckRole:superAdmin&admin'])->group(function () {
    Route::resource('/auth/faculty', FacultyController::class)->names('faculty');
    Route::resource('/auth/program', ProgramController::class)->names('program');
    Route::get('/auth/department/status/{department}', [DeparmentController::class, "status"])->name('department.status');
    Route::resource('/auth/department', DeparmentController::class)->names('department');
});

