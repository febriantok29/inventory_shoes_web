<?php

namespace App\Http\Controllers;

use App\Models\Master\Product;
use App\Models\Transaction\Sales;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data dari database
        $totalProducts = Product::count(); // Total produk
        $totalSales = Sales::sum('total_items'); // Total penjualan

        // Data mingguan sebagai contoh untuk grafik
        $weeklySales = Sales::selectRaw('DATE(created_at) as date, SUM(total_items) as total')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(7)
            ->get();

        // Kirim data ke view dashboard
        return view('dashboard', [
            'totalProducts' => $totalProducts,
            'totalSales' => $totalSales,
            'weeklySales' => $weeklySales,
        ]);
    }

    public function downloadReport()
    {
        $date = date('Y-m-d H:i:s');
        $fileName = "sales_report_{$date}.xlsx";
        return Excel::download(new SalesExport, $fileName);
    }
}
