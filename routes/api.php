<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SettingsController;

Route::resource('customers', CustomerController::class);
Route::delete('/customers', [CustomerController::class, 'destroyMultiple']);

Route::resource('invoices', InvoiceController::class);
Route::delete('/invoices', [InvoiceController::class, 'destroyMultiple']);

Route::get('/settings', [SettingsController::class, 'get']);
Route::put('/settings', [SettingsController::class, 'set']);
