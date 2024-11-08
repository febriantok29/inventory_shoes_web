<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Transactions\ProductSalesReturn;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductReturnReportController extends Controller
{
    public function index(Request $request)
    {
        // Filter periode waktu laporan
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Mengambil data retur dalam periode tertentu
        $returns = ProductSalesReturn::whereBetween('return_date', [$startDate, $endDate])->get();

        // Menghitung total retur dan jumlah transaksi
        $totalReturns = $returns->count();
        $totalQuantityReturned = $returns->sum('quantity');

        return view('reports.product_returns.index', compact('returns', 'totalReturns', 'totalQuantityReturned', 'startDate', 'endDate'));
    }
}
