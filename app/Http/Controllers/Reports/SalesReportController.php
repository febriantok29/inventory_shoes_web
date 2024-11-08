<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Transactions\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        // Menentukan periode laporan
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Mengambil data penjualan dalam periode tertentu
        $sales = Sale::whereBetween('created_at', [$startDate, $endDate])->get();

        // Menyusun data laporan
        $totalSales = $sales->sum('total_amount');
        $averageSales = $sales->avg('total_amount');
        $transactionCount = $sales->count();

        return view('reports.sales.index', compact('sales', 'totalSales', 'averageSales', 'transactionCount', 'startDate', 'endDate'));
    }
}
