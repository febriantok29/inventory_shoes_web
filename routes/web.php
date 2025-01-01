<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Transaction\SalesController;

Route::get('/', [DashboardController::class, 'index'])->name('home');

// Dashboard Route
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Master Data Routes
Route::prefix('master')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});

// Transaction Routes
Route::prefix('transactions')->group(function () {
    Route::resource('sales', SalesController::class);
});
