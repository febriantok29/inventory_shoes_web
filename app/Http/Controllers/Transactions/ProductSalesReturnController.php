<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transactions\ProductSalesReturn;
use App\Models\Transactions\ProductSalesReturnDetail;
use Illuminate\Http\Request;
use App\Models\Transactions\Sale;
use App\Models\Transactions\SaleDetail;
use App\Http\Controllers\Transactions\ProductStockTransactionController;

class ProductSalesReturnController extends Controller
{
    public function index()
    {
        $productSalesReturns = ProductSalesReturn::all();
        return view('transactions.product_sales_returns.index', compact('productSalesReturns'));
    }

    public function selectSale(Request $request)
    {
        $salesQuery = Sale::query();

        // Filter berdasarkan invoice atau rentang tanggal
        if ($request->filled('invoice')) {
            $salesQuery->whereRaw('lower(invoice) like ?', ['%' . strtolower($request->invoice) . '%']);
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $salesQuery->whereBetween('transaction_date', [$request->start_date, $request->end_date]);
        }

        $sales = $salesQuery->get();

        return view('transactions.product_sales_returns.select_sale', compact('sales'));
    }

    public function showSaleDetails(Sale $sale)
    {
        $saleDetails = $sale->details;
        return view('transactions.product_sales_returns.create', compact('sale', 'saleDetails'));
    }

    public function show(ProductSalesReturn $productSalesReturn)
    {
        return view('transactions.product_sales_returns.show', compact('productSalesReturn'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sale_id' => 'required|exists:t_sales,id',
            'return_date' => 'required|date|before_or_equal:today',
            'total_quantity' => 'required|numeric|min:0',
            'return_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'details' => 'required|array',
            'details.*.product_id' => 'required|exists:m_products,id',
            'details.*.price' => 'required|numeric|min:0',
            'details.*.return_quantity' => 'required|integer|min:1',
            'details.*.note' => 'nullable|string',
        ]);

        $sale = Sale::findOrFail($request->sale_id);

        $generatedCode = 'RET/' . date('Ymd') . '/' . $sale->invoice . '/' . str_pad(ProductSalesReturn::count() + 1, 4, '0', STR_PAD_LEFT);

        $totalQuantity = $validated['total_quantity'];
        $totalPrice = $validated['return_price'];
        $total = $totalQuantity * $totalPrice;

        $productSalesReturn = ProductSalesReturn::create([
            'code' => $generatedCode,
            'sales_id' => $sale->id,
            'return_date' => $validated['return_date'],
            'total_quantity' => $totalQuantity,
            'total_price' => $totalPrice,
            'total' => $total,
            'note' => $validated['description'] ?? '',
        ]);

        foreach ($validated['details'] as $detail) {
            $total = $detail['return_quantity'] * $detail['price'];

            $productStockTransactionController = new ProductStockTransactionController();
            $productStockTransactionId = $productStockTransactionController->addStock($detail['product_id'], $detail['return_quantity'], 'Retur Penjualan' . $productSalesReturn->code);

            ProductSalesReturnDetail::create([
                'product_sales_return_id' => $productSalesReturn->id,
                'product_id' => $detail['product_id'],
                'transaction_stock_id' => $productStockTransactionId,
                'quantity' => $detail['return_quantity'],
                'price' => $detail['price'],
                'total' => $total,
                'note' => $detail['note'] ?? '',
            ]);
        }

        return redirect()->route('product_sales_returns.index')->with('success', 'Berhasil menambahkan retur penjualan.');
    }
}
