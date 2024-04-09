<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::middleware('checkLogout')->name('login.')->group(function () {
        Route::get('login', [AuthController::class, 'getLogin'])->name('get');
        Route::post('login', [AuthController::class, 'postLogin'])->name('post');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('checkLogin')->name('company.')->group(function () {
        Route::get('list', [CompanyController::class, 'list'])->name('list');
        Route::get('get-data', [CompanyController::class, 'getData']);
        Route::post('approve-payment-request', [CompanyController::class, 'approvePaymentRequest']);
        Route::post('cancel-payment-request', [CompanyController::class, 'cancelPaymentRequest']);
    });
});