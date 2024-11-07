<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transactions\ProductStockTransaction;
use Illuminate\Http\Request;

class ProductStockTransactionController extends Controller
{
    public function index()
    {
        $stockTransactions = ProductStockTransaction::all();
        return view('transactions.product_stock.index', compact('stockTransactions'));
    }

    public function create()
    {
        return view('transactions.product_stock.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'transaction_type' => 'required|in:addition,reduction',
            'transaction_date' => 'required|date',
        ]);

        ProductStockTransaction::create($request->all());
        return redirect()->route('product_stock_transactions.index')->with('success', 'Stock transaction recorded successfully.');
    }

    public function show(ProductStockTransaction $productStockTransaction)
    {
        return view('transactions.product_stock.show', compact('productStockTransaction'));
    }

    public function edit(ProductStockTransaction $productStockTransaction)
    {
        return view('transactions.product_stock.edit', compact('productStockTransaction'));
    }

    public function update(Request $request, ProductStockTransaction $productStockTransaction)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'transaction_type' => 'required|in:addition,reduction',
            'transaction_date' => 'required|date',
        ]);

        $productStockTransaction->update($request->all());
        return redirect()->route('product_stock_transactions.index')->with('success', 'Stock transaction updated successfully.');
    }

    public function destroy(ProductStockTransaction $productStockTransaction)
    {
        $productStockTransaction->delete();
        return redirect()->route('product_stock_transactions.index')->with('success', 'Stock transaction deleted successfully.');
    }
}
