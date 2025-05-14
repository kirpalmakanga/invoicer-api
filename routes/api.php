<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;

Route::resources([
    'customers' => CustomerController::class,
    'invoices' => InvoiceController::class,
]);
