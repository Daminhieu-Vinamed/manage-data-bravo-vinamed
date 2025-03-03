<?php

use App\Http\Controllers\AdditionalWorkController;
use App\Http\Controllers\OnLeaveController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TimekeepingController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {

    Route::middleware('checkLogin')->group(function () {

        Route::get('welcome', [AuthController::class, 'welcome'])->name('welcome');

        Route::middleware('checkBirthday')->prefix('happy-birthday')->group(function () {
            Route::get('/', [EventController::class, 'happyBirthday']);
            Route::get('name', [EventController::class, 'happyBirthdayName']);
        });

        Route::put('change-password', [AuthController::class, 'changePassword']);

        Route::put('update-birthday', [AuthController::class, 'updateBirthday']);
        Route::put('update-name', [AuthController::class, 'updateName']);
        Route::put('update-username', [AuthController::class, 'updateUsername']);
        Route::put('update-email', [AuthController::class, 'updateEmail']);

        Route::prefix('suggestion')->name('suggestion.')->group(function () {
            Route::get('/', [SuggestionController::class, 'list'])->name('list');
            Route::get('get-data', [SuggestionController::class, 'getData']);
            Route::get('choose-company-list', [SuggestionController::class, 'chooseCompanyList'])->name('choose-company-list');
            Route::get('directional-list', [SuggestionController::class, 'directionalList'])->name('directional-list');
            Route::middleware('checkRoleManage')->group(function () {
                Route::get('statistical', [SuggestionController::class, 'statistical'])->name('statistical');
                Route::post('approve-payment-request', [SuggestionController::class, 'approve']);
                Route::post('cancel-payment-request', [SuggestionController::class, 'cancel']);
            });
            Route::get('choose-company-create', [SuggestionController::class, 'chooseCompanyCreate'])->name('choose-company-create');
            Route::get('directional-create', [SuggestionController::class, 'directionalCreate'])->name('directional-create');
            Route::get('directional-edit', [SuggestionController::class, 'directionalEdit'])->name('directional-edit');
            Route::get('payment-order', [SuggestionController::class, 'getPaymentOrder'])->name('payment-order');
            Route::post('create-payment-order', [SuggestionController::class, 'postPaymentOrder']);
            Route::get('edit-payment-order', [SuggestionController::class, 'editPaymentOrder'])->name('edit-payment-order');
            Route::post('update-payment-order', [SuggestionController::class, 'updatePaymentOrder']);
            Route::get('requests-for-advances', [SuggestionController::class, 'getRequestsForAdvances'])->name('requests-for-advances');
            Route::post('create-requests-for-advances', [SuggestionController::class, 'postRequestsForAdvances']);
            Route::get('edit-requests-for-advances', [SuggestionController::class, 'editRequestsForAdvances'])->name('edit-requests-for-advances');
            Route::post('update-requests-for-advances', [SuggestionController::class, 'updateRequestsForAdvances']);
            Route::get('suggested-per-diem', [SuggestionController::class, 'getSuggestedPerDiem'])->name('suggested-per-diem');
            Route::post('create-suggested-per-diem', [SuggestionController::class, 'postSuggestedPerDiem']);
            Route::get('edit-suggested-per-diem', [SuggestionController::class, 'editSuggestedPerDiem'])->name('edit-suggested-per-diem');
            Route::post('update-suggested-per-diem', [SuggestionController::class, 'updateSuggestedPerDiem']);
        });

        Route::middleware('checkRoleAdmin')->prefix('user')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'list'])->name('list');
            Route::get('get-data', [UserController::class, 'getData']);
            Route::post('create', [UserController::class, 'create']);
            Route::get('edit', [UserController::class, 'edit'])->name('edit');
            Route::post('update', [UserController::class, 'update']);
            Route::delete('delete', [UserController::class, 'delete']);
            Route::get('deleted', [UserController::class, 'deleted'])->name('deleted');
            Route::get('get-data-deleted', [UserController::class, 'getDataDeleted']);
            Route::post('restore', [UserController::class, 'restore']);
            Route::delete('destroy', [UserController::class, 'destroy']);
        });

        Route::prefix('warehouse')->name('warehouse.')->middleware('checkIsWarehouseActive')->group(function () {
            Route::get('look-up-inventory-by-QR', [WarehouseController::class, 'lookUpInventoryByQR'])->name('look-up-inventory-by-QR');
            Route::post('data-look-up-inventory-by-QR', [WarehouseController::class, 'getDataLookUpInventoryByQR'])->name('data-look-up-inventory-by-QR');
            Route::get('look-up-inventory-by-warehouse', [WarehouseController::class, 'lookUpInventoryByWarehouse'])->name('look-up-inventory-by-warehouse');
            Route::post('data-look-up-inventory-by-warehouse', [WarehouseController::class, 'getDataLookUpInventoryByWarehouse'])->name('data-look-up-inventory-by-warehouse');
            Route::get('quota-warning-report', [WarehouseController::class, 'quotaWarningReport'])->name('quota-warning-report');
            Route::post('data-quota-warning-report', [WarehouseController::class, 'getDataQuotaWarningReport'])->name('data-quota-warning-report');
            Route::get('recommend-warehouse-release', [WarehouseController::class, 'recommendWarehouseRelease'])->name('recommend-warehouse-release');
            Route::get('management-requests-warehouse-release', [WarehouseController::class, 'managementRequestsWarehouseRelease'])->name('management-requests-warehouse-release');
            Route::get('search-warehouse', [WarehouseController::class, 'searchWarehouse']);
            Route::get('search-supplies', [WarehouseController::class, 'searchSupplies']);
            Route::get('search-customer', [WarehouseController::class, 'searchCustomer']);
            Route::get('search-employee', [WarehouseController::class, 'searchEmployee']);
        });

        Route::prefix('notification')->name('notification.')->group(function () {
            Route::get('/', [NotificationController::class, 'list'])->name('list');
            Route::get('get-data', [NotificationController::class, 'getData']);
            Route::get('list-additional-work-and-on-leave', [NotificationController::class, 'listViewAdditionalWorkAndOnLeave'])->name('list-additional-work-and-on-leave');
            Route::get('get-data-additional-work-and-on-leave', [NotificationController::class, 'listDataAdditionalWorkAndOnLeave']);
        });

        Route::prefix('timekeeping')->name('timekeeping.')->group(function () {
            Route::get('/', [TimekeepingController::class, 'calendar'])->name('calendar');
            Route::get('get-data-timekeeping', [TimekeepingController::class, 'getTimeInTimekeeping']);
            Route::post('supplements-and-leave', [TimekeepingController::class, 'supplementsAndLeave']);
            Route::post('clock-in', [TimekeepingController::class, 'clockIn']);
            Route::post('clock-out', [TimekeepingController::class, 'clockOut']);
            Route::middleware('checkRoleManage')->group(function () {
                Route::put('approve', [TimekeepingController::class, 'approve']);
            });
            Route::put('cancel', [TimekeepingController::class, 'cancel']);
        });

        Route::prefix('on-leave')->name('on-leave.')->group(function () {
            Route::middleware('checkRoleManage')->group(function () {
                Route::get('/', [OnLeaveController::class, 'list'])->name('list');
                Route::get('get-data', [OnLeaveController::class, 'getData']);
            });
            Route::get('calendar', [OnLeaveController::class, 'calendar'])->name('calendar');
        });

        Route::prefix('additional-work')->name('additional-work.')->group(function () {
            Route::middleware('checkRoleManage')->group(function () {
                Route::get('/', [AdditionalWorkController::class, 'list'])->name('list');
                Route::get('get-data', [AdditionalWorkController::class, 'getData']);
            });
            Route::get('calendar', [AdditionalWorkController::class, 'calendar'])->name('calendar');
        });
    });

    Route::middleware('checkLogout')->name('login.')->group(function () {
        Route::get('login', [AuthController::class, 'getLogin'])->name('get');
        Route::post('login', [AuthController::class, 'postLogin'])->name('post');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});