<?php

use App\Http\Controllers\Admin\PaymentOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    
    Route::prefix('admin')->name('admin.')->group(function () {
        
        Route::get('dashboard', [DashboardController::class, 'dashboardAdmin'])->name('dashboard');
        
        Route::middleware('checkLogout')->name('login.')->group(function () {
            Route::get('login', [AuthController::class, 'getAdminLogin'])->name('get');
            Route::post('login', [AuthController::class, 'postAdminLogin'])->name('post');
        });
        
        Route::prefix('payment-order')->middleware('checkAdminLogin')->name('payment-order.')->group(function () {
            Route::get('/', [PaymentOrderController::class, 'list'])->name('list');
            Route::get('get-data', [PaymentOrderController::class, 'getData']);
            Route::post('approve-payment-request', [PaymentOrderController::class, 'approve']);
            Route::post('cancel-payment-request', [PaymentOrderController::class, 'cancelPaymentRequest']);
            Route::get('create', [PaymentOrderController::class, 'create'])->name('create');
            Route::get('get-data-create', [PaymentOrderController::class, 'getDataCreate']);
        });
        
    });

    Route::prefix('client')->name('client.')->group(function () {
    
        Route::middleware('checkLogout')->name('login.')->group(function () {
            Route::get('login', [AuthController::class, 'getClientLogin'])->name('get');
            Route::post('login', [AuthController::class, 'postClientLogin'])->name('post');
        });

    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    
});