<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PaymentOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\StatisticalController as StatisticalAdmin;
use App\Http\Controllers\Manage\StatisticalController as StatisticalManage;
use App\Http\Controllers\TimekeepingController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    
    Route::middleware('checkLogin')->group(function () {

        Route::get('welcome', [AuthController::class, 'welcome']);
        
        Route::prefix('statistical')->name('statistical.')->group(function () {
            Route::middleware('checkRoleAdmin')->prefix('admin')->name('admin.')->group(function () {
                Route::get('payment-order', [StatisticalAdmin::class, 'paymentOrder'])->name('payment-order'); 
                Route::get('on-leave', [StatisticalAdmin::class, 'onLeave'])->name('on-leave'); 
            });
            Route::middleware('checkRoleManage')->prefix('manage')->name('manage.')->group(function () {
                Route::get('payment-order', [StatisticalManage::class, 'paymentOrder'])->name('payment-order'); 
                Route::get('on-leave', [StatisticalManage::class, 'onLeave'])->name('on-leave'); 
            });
        });
        
        Route::prefix('payment-order')->name('payment-order.')->group(function () {
            Route::get('/', [PaymentOrderController::class, 'list'])->name('list');
            Route::get('get-data', [PaymentOrderController::class, 'getData']);
            Route::post('approve-payment-request', [PaymentOrderController::class, 'approve']);
            Route::post('cancel-payment-request', [PaymentOrderController::class, 'cancelPaymentRequest']);
            Route::get('choose-company', [PaymentOrderController::class, 'chooseCompany'])->name('choose-company');
            Route::get('create', [PaymentOrderController::class, 'create'])->name('create');
            Route::get('get-data-create', [PaymentOrderController::class, 'getDataCreate']);
        });

        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'list'])->name('list');
            Route::get('get-data', [UserController::class, 'getData']);
            Route::post('create', [UserController::class, 'create']);
            Route::get('edit', [UserController::class, 'edit']);
            Route::delete('delete', [UserController::class, 'delete']);
        });

        Route::prefix('timekeeping')->name('timekeeping.')->group(function () {
            Route::get('/', [TimekeepingController::class, 'list'])->name('list');
            Route::post('additional-work', [TimekeepingController::class, 'additionalWork']);
            Route::post('clock-in', [TimekeepingController::class, 'clockIn']);
            Route::put('clock-out', [TimekeepingController::class, 'clockOut']);
        });
        
    });

    Route::middleware('checkLogout')->name('login.')->group(function () {
        Route::get('login', [AuthController::class, 'getLogin'])->name('get');
        Route::post('login', [AuthController::class, 'postLogin'])->name('post');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    
});