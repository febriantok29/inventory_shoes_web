<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transactions\Sale;
use Illuminate\Http\Request;
use App\Models\Master\Product;
use App\Models\Transactions\SaleDetail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Transactions\ProductStockTransactionController;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('details.product')->latest()->paginate(10);
        return view('transactions.sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('transactions.sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'note' => 'nullable|string',
            'transaction_date' => 'required|date|before_or_equal:today',
            'details' => 'required|array',
            'details.*.product_id' => 'required|exists:m_products,id',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.price' => 'required|numeric|min:0',
            'details.*.note' => 'nullable|string',
        ]);

        $details = $validated['details'];
        foreach ($details as $detail) {
            $product = Product::findOrFail($detail['product_id']);
            if ($product->stock < $detail['quantity']) {
                return redirect()->back()->withInput()->with('error', 'Stock ' . $product->name . ' tidak mencukupi, stock saat ini: ' . $product->stock);
            }
        }

        $salesCount = str_pad(Sale::count() + 1, 4, '0', STR_PAD_LEFT);
        $generatedInvoice = 'INV/' . date('Ymd') . '/' . Auth::id() . '/' . $salesCount;

        $sale = Sale::create([
            'invoice' => $generatedInvoice,
            'customer_name' => $validated['customer_name'],
            'transaction_date' => $request->transaction_date,
            'total_amount' => 0,
            'total_price' => 0,
            'employee_id' => Auth::id(),
            'note' => $validated['note'],
        ]);

        $totalAmount = 0;
        $totalPrice = 0;

        $productStockTransactionController = new ProductStockTransactionController();

        foreach ($validated['details'] as $detail) {
            $product = Product::findOrFail($detail['product_id']);
            $total = $detail['quantity'] * $detail['price'];

            SaleDetail::create([
                'sales_id' => $sale->id,
                'product_id' => $product->id,
                'quantity' => $detail['quantity'],
                'price' => $detail['price'],
                'total' => $total,
                'note' => $detail['note'],
            ]);

            $productStockTransactionController->addSale($product->id, $detail['quantity'], $detail['note']);

            $totalAmount += $detail['quantity'];
            $totalPrice += $total;
        }

        $sale->update([
            'total_amount' => $totalAmount,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('sales.index')->with('success', 'Berhasil menambahkan penjualan');
    }

    public function show(Sale $sale)
    {
        $sale->load('details.product');
        return view('transactions.sales.show', compact('sale'));
    }
}
