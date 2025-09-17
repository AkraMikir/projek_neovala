<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('customers', CustomerController::class);
Route::resource('products', ProductController::class);
Route::resource('sales', SaleController::class);

Route::get('/sales/{sale}/print', [SaleController::class, 'print'])->name('sales.print');
