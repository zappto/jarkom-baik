<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomingStockController;
use App\Http\Controllers\OutgoingStockController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('incoming-stock', IncomingStockController::class);
Route::resource('outgoing-stock', OutgoingStockController::class);
