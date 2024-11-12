<?php

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
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth')->group(function () {
    // Dashboard Route
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data Routes
    Route::prefix('master')->group(function () {
        Route::resource('product_categories', ProductCategoryController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('employees', EmployeeController::class);
        Route::resource('products', ProductController::class);
    });

    // Transaction Routes
    Route::prefix('transactions')->group(function () {
        Route::resource('sales', SaleController::class);
        Route::resource('damaged_products', DamagedProductController::class);
        Route::resource('product_stock_transactions', ProductStockTransactionController::class);
        Route::resource('product_purchases', ProductPurchaseController::class);
        Route::resource('product_sales_returns', ProductSalesReturnController::class);
    });

    // Report Routes
    Route::prefix('reports')->group(function () {
        Route::get('sales_report', [SalesReportController::class, 'index'])->name('reports.sales_report');
        Route::get('product_quality', [ProductQualityReportController::class, 'index'])->name('reports.product_quality');
        Route::get('product_sales', [ProductSalesReportController::class, 'index'])->name('reports.product_sales');
        Route::get('product_purchase', [ProductPurchaseReportController::class, 'index'])->name('reports.product_purchase');
    });
});

// require __DIR__ . '/auth.php';
