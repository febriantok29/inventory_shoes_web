<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transactions\Sale;
use Illuminate\Http\Request;
use App\Models\Master\Product;
use App\Models\Transactions\SaleDetail;
use Illuminate\Support\Facades\Auth;

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
            'details' => 'required|array',
            'details.*.product_id' => 'required|exists:m_products,id',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.price' => 'required|numeric|min:0',
        ]);

        $sale = Sale::create([
            'customer_name' => $validated['customer_name'],
            'total_amount' => 0,
            'total_price' => 0,
            'created_by' => Auth::id(),
        ]);

        $totalAmount = 0;
        $totalPrice = 0;

        foreach ($validated['details'] as $detail) {
            $product = Product::findOrFail($detail['product_id']);
            $total = $detail['quantity'] * $detail['price'];

            SaleDetail::create([
                'sales_id' => $sale->id,
                'product_id' => $product->id,
                'quantity' => $detail['quantity'],
                'price' => $detail['price'],
                'total' => $total,
            ]);

            $product->decrement('stock', $detail['quantity']);

            $totalAmount += $detail['quantity'];
            $totalPrice += $total;
        }

        $sale->update([
            'total_amount' => $totalAmount,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('transactions.sales.index')->with('success', 'Sale created successfully');
    }

    public function show(Sale $sale)
    {
        $sale->load('details.product');
        return view('transactions.sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        $products = Product::all();
        $sale->load('details');
        return view('transactions.sales.edit', compact('sale', 'products'));
    }

    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'details' => 'required|array',
            'details.*.product_id' => 'required|exists:m_products,id',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.price' => 'required|numeric|min:0',
        ]);

        $sale->update([
            'customer_name' => $validated['customer_name'],
            'updated_by' => Auth::id(),
        ]);

        $sale->details()->delete();

        $totalAmount = 0;
        $totalPrice = 0;

        foreach ($validated['details'] as $detail) {
            $product = Product::findOrFail($detail['product_id']);
            $total = $detail['quantity'] * $detail['price'];

            SaleDetail::create([
                'sales_id' => $sale->id,
                'product_id' => $product->id,
                'quantity' => $detail['quantity'],
                'price' => $detail['price'],
                'total' => $total,
            ]);

            $product->decrement('stock', $detail['quantity']);

            $totalAmount += $detail['quantity'];
            $totalPrice += $total;
        }

        $sale->update([
            'total_amount' => $totalAmount,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('transactions.sales.index')->with('success', 'Sale updated successfully');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('transactions.sales.index')->with('success', 'Sale deleted successfully');
    }
}
