<?php

use App\Http\Controllers\AdditionalWorkController;
use App\Http\Controllers\OnLeaveController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TimekeepingController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {

    Route::middleware('checkLogin')->group(function () {

        Route::get('welcome', [AuthController::class, 'welcome'])->name('welcome');

        Route::put('change-password', [AuthController::class, 'changePassword']);

        Route::get('mark-as-read/{id}', [AuthController::class, 'markAsRead'])->name('mark-as-read');

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
            Route::get('edit-requests-for-advances', [SuggestionController::class, 'getRequestsForAdvances'])->name('edit-requests-for-advances');
            Route::post('create-requests-for-advances', [SuggestionController::class, 'postRequestsForAdvances']);
            Route::get('suggested-per-diem', [SuggestionController::class, 'getSuggestedPerDiem'])->name('suggested-per-diem');
            Route::post('create-suggested-per-diem', [SuggestionController::class, 'postSuggestedPerDiem']);
        });

        Route::middleware('checkRoleAdmin')->prefix('user')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'list'])->name('list');
            Route::get('get-data', [UserController::class, 'getData']);
            Route::post('create', [UserController::class, 'create']);
            Route::get('edit', [UserController::class, 'edit'])->name('edit');
            Route::post('update', [UserController::class, 'update']);
            Route::delete('delete', [UserController::class, 'delete']);
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