<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transactions\ProductPurchase;
use Illuminate\Http\Request;

class ProductPurchaseController extends Controller
{
    public function index()
    {
        $productPurchases = ProductPurchase::all();
        return view('transactions.product_purchases.index', compact('productPurchases'));
    }

    public function create()
    {
        return view('transactions.product_purchases.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'purchase_price' => 'required|numeric|min:0',
            'supplier_name' => 'required|string|max:255',
            'purchase_date' => 'required|date',
        ]);

        ProductPurchase::create($request->all());
        return redirect()->route('product_purchases.index')->with('success', 'Product purchase recorded successfully.');
    }

    public function show(ProductPurchase $productPurchase)
    {
        return view('transactions.product_purchases.show', compact('productPurchase'));
    }

    public function edit(ProductPurchase $productPurchase)
    {
        return view('transactions.product_purchases.edit', compact('productPurchase'));
    }

    public function update(Request $request, ProductPurchase $productPurchase)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'purchase_price' => 'required|numeric|min:0',
            'supplier_name' => 'required|string|max:255',
            'purchase_date' => 'required|date',
        ]);

        $productPurchase->update($request->all());
        return redirect()->route('product_purchases.index')->with('success', 'Product purchase updated successfully.');
    }

    public function destroy(ProductPurchase $productPurchase)
    {
        $productPurchase->delete();
        return redirect()->route('product_purchases.index')->with('success', 'Product purchase deleted successfully.');
    }
}
