<?php

use App\Http\Controllers\PaymentOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    
    Route::middleware('checkLogin')->group(function () {
        
        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::get('admin', [DashboardController::class, 'statisticalAdmin'])->middleware('checkRoleAdmin')->name('admin'); 
            Route::get('manage', [DashboardController::class, 'statisticalManage'])->middleware('checkRoleManage')->name('manage'); 
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
        
    });

    Route::middleware('checkLogout')->name('login.')->group(function () {
        Route::get('login', [AuthController::class, 'getLogin'])->name('get');
        Route::post('login', [AuthController::class, 'postLogin'])->name('post');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    
});