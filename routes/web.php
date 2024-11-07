<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\ProductCategoryController;
use App\Http\Controllers\Master\SupplierController;
use App\Http\Controllers\Transactions\SaleController;
use App\Http\Controllers\Reports\SalesReportController;
use App\Http\Controllers\Reports\ProductQualityReportController;
use App\Http\Controllers\Transactions\DamagedProductController;
use App\Http\Controllers\Master\EmployeeController;
use App\Http\Controllers\Transactions\ProductStockTransactionController;
use App\Http\Controllers\Reports\ProductSalesReportController;
use App\Http\Controllers\Transactions\ProductPurchaseController;
use App\Http\Controllers\Reports\ProductPurchaseReportController;
use App\Http\Controllers\Transactions\ProductSalesReturnController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Master Data
Route::resource('product_categories', ProductCategoryController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('employees', EmployeeController::class);

// Transactions
Route::resource('sales', SaleController::class);
Route::resource('damaged_products', DamagedProductController::class);
Route::resource('product_stock_transactions', ProductStockTransactionController::class);
Route::resource('product_purchases', ProductPurchaseController::class);
Route::resource('product_sales_returns', ProductSalesReturnController::class);

// Reports
Route::get('sales_report', [SalesReportController::class, 'index'])->name('sales_report.index');
Route::get('product_quality_report', [ProductQualityReportController::class, 'index'])->name('product_quality_report.index');
Route::get('product_sales_report', [ProductSalesReportController::class, 'index'])->name('product_sales_report.index');
Route::get('product_purchase_report', [ProductPurchaseReportController::class, 'index'])->name('product_purchase_report.index');

require __DIR__ . '/auth.php';
