<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeparmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HodDepartmentAssignController;
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
Route::get('clear-all', function () {
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('clear-compiled');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    dd('Cached Cleared' . ' view:clear ' . ' config:clear ' .
    ' cache:clear ' . ' config:cache ' . ' clear-compiled ' .
    ' route:clear ');
});

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Route::get('/education/pdf/{pdf}',[AuthController::class,'pdf'])->name('pdf');

// multiple user check (superAdmin and admin)
Route::middleware(['auth', 'CheckRole:superAdmin&admin'])->group(function () {
    Route::resource('/auth/faculty', FacultyController::class)->names('faculty');
    //remember to work on gender crud (-mcrs is already created)
    Route::resource('/auth/program', ProgramController::class)->names('program');
    Route::get('/auth/department/status/{department}', [DeparmentController::class, "status"])->name('department.status');
    Route::get('/auth/department/{waiver}/edit', [DeparmentController::class, "waiver_edit"])->name('department.waiver.edit');
    Route::post('/auth/department/{waiver}/update', [DeparmentController::class, "waiver_update"])->name('department.waiver.update');
    Route::get('/auth/hod_department_assign/status/{hodDepartmentAssign}', [HodDepartmentAssignController::class, "status"])->name('hod.department.assign.status');
    Route::resource('/auth/department', DeparmentController::class)->names('department');
    Route::resource('/auth/hod_department_assign', HodDepartmentAssignController::class)->names('hod.department.assign');
});
