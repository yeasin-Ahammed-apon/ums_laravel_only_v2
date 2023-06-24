<?php

use App\Http\Controllers\storeManagement\InventoryCategoriesController as InventoryCategories;
use App\Http\Controllers\storeManagement\InventoryItemController as InventoryItem;
use App\Http\Controllers\storeManagement\InventoryStockInController as StockInController;
use App\Http\Controllers\userManagement\AccountController;
use App\Http\Controllers\userManagement\AdminController;
use App\Http\Controllers\userManagement\AdmissionController;
use App\Http\Controllers\userManagement\CodController;
use App\Http\Controllers\superAdmin\SuperAdminController;
use App\Http\Controllers\userManagement\HodController;
use App\Http\Controllers\userManagement\HrController;
use App\Http\Controllers\userManagement\LibrarianController;
use App\Http\Controllers\superAdmin\SuperAdminNotificationController as NotificationController;
use App\Http\Controllers\superAdmin\SuperAdminPageSettingController as PageSettingController;
use App\Http\Controllers\superAdmin\SuperAdminSidebarController as SidebarController;
use App\Http\Controllers\userManagement\StoreManagerController;
use App\Http\Controllers\userManagement\TeacherController;
use Illuminate\Support\Facades\Route;


/**
 * [Note]
 * few controller name was shorten.
 * */

// superAdmin routes
Route::middleware(['auth', 'CheckRole:superAdmin'])->group(function () {
    Route::prefix('/superAdmin')->group(function () {
        //superAdmin
        Route::get('/dashboard', [SuperAdminController::class, "dashboard"])->name('superAdmin.dashboard');
        Route::get('/profile', [SuperAdminController::class, "profile"])->name('superAdmin.profile');
        //table for user type was sildebar
        Route::resource('/sidebar', SidebarController::class)->names('superAdmin.sidebar');
        //user page settings
        Route::get('/user/page/settings/{id}', [PageSettingController::class, "user_page_settings"])->name('superAdmin.page.settings');
        Route::post('/user/page/settings', [PageSettingController::class, "user_page_settings_update"])->name('superAdmin.page.settings.update');
        // admin
        Route::get('/admin/status/{id}', [AdminController::class, "status"])->name('superAdmin.admin.status');
        Route::get('/admin/trash', [AdminController::class, "trash"])->name('superAdmin.admin.trash');
        Route::get('/admin/restore/{id}', [AdminController::class, "restore"])->name('superAdmin.admin.restore');
        Route::get('/admin/forcedelete/{id}', [AdminController::class, "forcedelete"])->name('superAdmin.admin.forcedelete');
        Route::resource('/admin', AdminController::class)->names('superAdmin.admin');
        // admission
        Route::get('/admission/status/{id}', [AdmissionController::class, "status"])->name('superAdmin.admission.status');
        Route::resource('/admission', AdmissionController::class)->names('superAdmin.admission');
        // account
        Route::get('/account/status/{id}', [AccountController::class, "status"])->name('superAdmin.account.status');
        Route::resource('/account', AccountController::class)->names('superAdmin.account');
        // hod
        Route::get('/hod/status/{id}', [HodController::class, "status"])->name('superAdmin.hod.status');
        Route::resource('/hod', HodController::class)->names('superAdmin.hod');
        // cod
        Route::get('/cod/make/hod/{id}', [CodController::class, "hod"])->name('superAdmin.cod.hod');
        Route::get('/cod/status/{id}', [CodController::class, "status"])->name('superAdmin.cod.status');
        Route::resource('/cod', CodController::class)->names('superAdmin.cod');
        // teacher
        Route::get('/teacher/make/hod/{id}', [TeacherController::class, "hod"])->name('superAdmin.teacher.hod');
        Route::get('/teacher/make/cod/{id}', [TeacherController::class, "cod"])->name('superAdmin.teacher.cod');
        Route::get('/teacher/status/{id}', [TeacherController::class, "status"])->name('superAdmin.teacher.status');
        Route::resource('/teacher', TeacherController::class)->names('superAdmin.teacher');
        // hr
        Route::get('/hr/status/{id}', [HrController::class, "status"])->name('superAdmin.hr.status');
        Route::resource('/hr', HrController::class)->names('superAdmin.hr');
        // librarian
        Route::get('/librarian/status/{id}', [LibrarianController::class, "status"])->name('superAdmin.librarian.status');
        Route::resource('/librarian', LibrarianController::class)->names('superAdmin.librarian');
        // storeManager
        Route::get('/storeManager/status/{id}', [StoreManagerController::class, "status"])->name('superAdmin.storeManager.status');
        Route::resource('/storeManager', StoreManagerController::class)->names('superAdmin.storeManager');
        // notification user wise
        Route::get('/notification/superAdmin', [NotificationController::class, "notification_superAdmin"])->name('superAdmin.notification.superAdmin');
        Route::get('/notification/admin', [NotificationController::class, "notification_admin"])->name('superAdmin.notification.admin');
        Route::get('/notification/hod', [NotificationController::class, "notification_hod"])->name('superAdmin.notification.hod');
        Route::get('/notification/cod', [NotificationController::class, "notification_cod"])->name('superAdmin.notification.cod');
        Route::get('/notification/teacher', [NotificationController::class, "notification_teacher"])->name('superAdmin.notification.teacher');
        Route::get('/notification/account', [NotificationController::class, "notification_account"])->name('superAdmin.notification.account');
        Route::get('/notification/admission', [NotificationController::class, "notification_admission"])->name('superAdmin.notification.admission');
    });
    Route::prefix('/superAdmin/inventory')->group(function () {
        //inventory categorie crud
        Route::get('/categorie/status/{id}', [InventoryCategories::class, "status"])->name('superAdmin.inventory.categorie.status');
        Route::resource('/categorie', InventoryCategories::class)->names('superAdmin.inventory.categorie');
        //inventory
        Route::get('/item/stock_in', [StockInController::class, "stock_in"])->name('superAdmin.inventory.item.stock_in');
        Route::post('/item/search', [StockInController::class, 'search'])->name('item_search');

        //inventory item crud
        Route::get('/item/status/{id}', [InventoryItem::class, "status"])->name('superAdmin.inventory.item.status');
        Route::resource('/item', InventoryItem::class)->names('superAdmin.inventory.item');
    });
});
