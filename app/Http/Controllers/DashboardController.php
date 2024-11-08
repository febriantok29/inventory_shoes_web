<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        // Data dummy untuk $salesLabels dan $salesData
        $salesLabels = ['January', 'February', 'March', 'April', 'May'];
        $salesData = [1500, 2000, 1700, 2500, 2200];

        // Data dummy untuk $stockLabels dan $stockData
        $stockLabels = ['Product A', 'Product B', 'Product C', 'Product D'];
        $stockData = [100, 80, 60, 40];

        // Data statistik untuk dashboard
        $totalProducts = 500; // contoh data
        $totalSales = 1000; // contoh data
        $stockLevel = 300; // contoh data
        $damagedProducts = 20; // contoh data

        return view('dashboard', compact(
            'salesLabels',
            'salesData',
            'stockLabels',
            'stockData',
            'totalProducts',
            'totalSales',
            'stockLevel',
            'damagedProducts'
        ));
    }
}



/*
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Product;
use  App\Models\Transactions\Sale;
use App\Models\Transactions\DamagedProduct;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data dari database
        $totalProducts = Product::count(); // Total produk
        $totalSales = Sale::sum('amount'); // Total penjualan
        $totalDamagedProducts = DamagedProduct::count(); // Total produk rusak

        // Data mingguan sebagai contoh untuk grafik
        $weeklySales = Sale::selectRaw('DATE(created_at) as date, SUM(amount) as total')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(7)
            ->get();

        // Kirim data ke view dashboard
        return view('dashboard', [
            'totalProducts' => $totalProducts,
            'totalSales' => $totalSales,
            'totalDamagedProducts' => $totalDamagedProducts,
            'weeklySales' => $weeklySales,
        ]);
    }
}

*/
