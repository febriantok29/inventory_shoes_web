<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Transactions\ProductPurchase;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductPurchaseReportController extends Controller
{
    public function index(Request $request)
    {
        // Filter periode laporan
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Mengambil data pembelian dalam periode tertentu
        $purchases = ProductPurchase::whereBetween('purchase_date', [$startDate, $endDate])->get();

        // Menyusun data laporan
        $totalCost = $purchases->sum(function ($purchase) {
            return $purchase->purchase_price * $purchase->quantity;
        });
        $totalQuantity = $purchases->sum('quantity');
        $transactionCount = $purchases->count();

        return view('reports.product_purchases.index', compact('purchases', 'totalCost', 'totalQuantity', 'transactionCount', 'startDate', 'endDate'));
    }
}
