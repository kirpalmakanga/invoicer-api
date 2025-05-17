<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AuthController;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'authentication']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api');
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::resource('customers', CustomerController::class);
Route::delete('/customers', [CustomerController::class, 'destroyMultiple']);

Route::resource('invoices', InvoiceController::class);
Route::delete('/invoices', [InvoiceController::class, 'destroyMultiple']);

Route::get('/settings', [SettingsController::class, 'get']);
Route::put('/settings', [SettingsController::class, 'set']);
