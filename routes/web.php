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

        Route::prefix('suggestion')->name('suggestion.')->group(function () {
            Route::get('/', [SuggestionController::class, 'list'])->name('list');
            Route::middleware('checkRoleManage')->group(function () {
                Route::get('statistical', [SuggestionController::class, 'statistical'])->name('statistical');
                Route::post('approve-payment-request', [SuggestionController::class, 'approve']);
                Route::post('cancel-payment-request', [SuggestionController::class, 'cancel']);
            });
            Route::get('choose-company', [SuggestionController::class, 'chooseCompany'])->name('choose-company');
            Route::get('payment-order', [SuggestionController::class, 'paymentOrder'])->name('payment-order');
            Route::get('directional', [SuggestionController::class, 'directional'])->name('directional');
            Route::get('requests-for-advances', [SuggestionController::class, 'requestsForAdvances'])->name('requests-for-advances');
            Route::get('suggested-per-diem', [SuggestionController::class, 'suggestedPerDiem'])->name('suggested-per-diem');
            Route::post('store', [SuggestionController::class, 'store'])->name('store');
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
            Route::post('supplements-and-leave', [TimekeepingController::class, 'supplementsAndLeave']);
            Route::post('clock-in', [TimekeepingController::class, 'clockIn']);
            Route::post('clock-out', [TimekeepingController::class, 'clockOut']);
        });

        Route::prefix('on-leave')->name('on-leave.')->group(function () {
            Route::middleware('checkRoleManage')->group(function () {
                Route::get('/', [OnLeaveController::class, 'list'])->name('list');
                Route::get('get-data', [OnLeaveController::class, 'getData']);
                Route::put('approve', [OnLeaveController::class, 'approve']);
            });
            Route::put('cancel', [OnLeaveController::class, 'cancel']);
            Route::get('calendar', [OnLeaveController::class, 'calendar'])->name('calendar');
        });

        Route::prefix('additional-work')->name('additional-work.')->group(function () {
            Route::middleware('checkRoleManage')->group(function () {
                Route::get('/', [AdditionalWorkController::class, 'list'])->name('list');
                Route::get('get-data', [AdditionalWorkController::class, 'getData']);
                Route::put('approve', [AdditionalWorkController::class, 'approve']);
            });
            Route::put('cancel', [AdditionalWorkController::class, 'cancel']);
            Route::get('calendar', [AdditionalWorkController::class, 'calendar'])->name('calendar');
        });
    });

    Route::middleware('checkLogout')->name('login.')->group(function () {
        Route::get('login', [AuthController::class, 'getLogin'])->name('get');
        Route::post('login', [AuthController::class, 'postLogin'])->name('post');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});