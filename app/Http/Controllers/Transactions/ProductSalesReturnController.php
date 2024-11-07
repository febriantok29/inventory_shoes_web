<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transactions\ProductSalesReturn;
use Illuminate\Http\Request;

class ProductSalesReturnController extends Controller
{
    public function index()
    {
        $productSalesReturns = ProductSalesReturn::all();
        return view('transactions.product_sales_returns.index', compact('productSalesReturns'));
    }

    public function create()
    {
        return view('transactions.product_sales_returns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'return_reason' => 'nullable|string',
            'return_date' => 'required|date',
        ]);

        ProductSalesReturn::create($request->all());
        return redirect()->route('product_sales_returns.index')->with('success', 'Sales return recorded successfully.');
    }

    public function show(ProductSalesReturn $productSalesReturn)
    {
        return view('transactions.product_sales_returns.show', compact('productSalesReturn'));
    }

    public function edit(ProductSalesReturn $productSalesReturn)
    {
        return view('transactions.product_sales_returns.edit', compact('productSalesReturn'));
    }

    public function update(Request $request, ProductSalesReturn $productSalesReturn)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'return_reason' => 'nullable|string',
            'return_date' => 'required|date',
        ]);

        $productSalesReturn->update($request->all());
        return redirect()->route('product_sales_returns.index')->with('success', 'Sales return updated successfully.');
    }

    public function destroy(ProductSalesReturn $productSalesReturn)
    {
        $productSalesReturn->delete();
        return redirect()->route('product_sales_returns.index')->with('success', 'Sales return deleted successfully.');
    }
}
