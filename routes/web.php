<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentOrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::middleware('checkLogout')->name('login.')->group(function () {
        Route::get('login', [AuthController::class, 'getLogin'])->name('get');
        Route::post('login', [AuthController::class, 'postLogin'])->name('post');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('payment-order')->middleware('checkLogin')->name('payment-order.')->group(function () {
        Route::get('/', [PaymentOrderController::class, 'list'])->name('list');
        Route::get('get-data', [PaymentOrderController::class, 'getData']);
        Route::post('approve-payment-request', [PaymentOrderController::class, 'approve']);
        Route::post('cancel-payment-request', [PaymentOrderController::class, 'cancelPaymentRequest']);
    });
});