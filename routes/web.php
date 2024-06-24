<?php

use App\Http\Controllers\AdditionalWorkController;
use App\Http\Controllers\OnLeaveController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PaymentOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TimekeepingController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    
    Route::middleware('checkLogin')->group(function () {

        Route::get('welcome', [AuthController::class, 'welcome']);
        
        Route::prefix('payment-order')->name('payment-order.')->group(function () {
            Route::get('/', [PaymentOrderController::class, 'list'])->name('list');
            Route::get('get-data', [PaymentOrderController::class, 'getData']);
            Route::middleware('checkRoleManage')->group(function () {
                Route::get('statistical', [PaymentOrderController::class, 'statistical'])->name('statistical');
                Route::post('approve-payment-request', [PaymentOrderController::class, 'approve']);
                Route::post('cancel-payment-request', [PaymentOrderController::class, 'cancel']);
            });
            Route::get('choose-company', [PaymentOrderController::class, 'chooseCompany'])->name('choose-company');
            Route::get('create', [PaymentOrderController::class, 'create'])->name('create');
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
            Route::put('clock-out', [TimekeepingController::class, 'clockOut']);
        });

        Route::prefix('on-leave')->name('on-leave.')->group(function () {
            Route::middleware('checkRoleManage')->get('/', [OnLeaveController::class, 'list'])->name('list');
            Route::get('calendar', [OnLeaveController::class, 'calendar'])->name('calendar');
            Route::get('get-data', [OnLeaveController::class, 'getData']);
            Route::put('approve', [OnLeaveController::class, 'approve']);
            Route::put('cancel', [OnLeaveController::class, 'cancel']);
        });
        
        Route::prefix('additional-work')->name('additional-work.')->group(function () {
            Route::middleware('checkRoleManage')->get('/', [AdditionalWorkController::class, 'list'])->name('list');
            Route::get('calendar', [AdditionalWorkController::class, 'calendar'])->name('calendar');
            Route::get('get-data', [AdditionalWorkController::class, 'getData']);
            Route::put('approve', [AdditionalWorkController::class, 'approve']);
            Route::put('cancel', [AdditionalWorkController::class, 'cancel']);
        });
        
    });

    Route::middleware('checkLogout')->name('login.')->group(function () {
        Route::get('login', [AuthController::class, 'getLogin'])->name('get');
        Route::post('login', [AuthController::class, 'postLogin'])->name('post');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    
});