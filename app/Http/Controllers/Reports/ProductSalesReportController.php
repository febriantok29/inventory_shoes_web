<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Transactions\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductSalesReportController extends Controller
{
    public function index(Request $request)
    {
        // Filter periode waktu laporan
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Mengambil data penjualan dalam periode tertentu
        $sales = Sale::whereBetween('sale_date', [$startDate, $endDate])->get();

        // Menyusun data laporan
        $totalSales = $sales->sum('total_amount');
        $averageSales = $sales->avg('total_amount');
        $transactionCount = $sales->count();

        return view('reports.product_sales.index', compact('sales', 'totalSales', 'averageSales', 'transactionCount', 'startDate', 'endDate'));
    }
}
