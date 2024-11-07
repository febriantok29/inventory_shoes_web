<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Transactions\ProductQualityReport;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductQualityReportController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil tanggal mulai dan akhir untuk filter laporan
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Mengambil data laporan kualitas produk dalam periode tertentu
        $qualityReports = ProductQualityReport::whereBetween('reported_date', [$startDate, $endDate])->get();

        return view('reports.product_quality.index', compact('qualityReports', 'startDate', 'endDate'));
    }
}
