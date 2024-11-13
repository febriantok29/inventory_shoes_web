<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Master\Product;
use App\Models\Transactions\ProductPurchase;
use App\Models\Master\Supplier;
use App\Http\Controllers\Transactions\ProductStockTransactionController;
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
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('transactions.product_purchases.create', compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'purchase_price' => str_replace('.', '', $request->purchase_price),
            'total_cost' => str_replace('.', '', $request->total_cost),
        ]);

        $request->validate([
            'product_id' => 'required|integer|exists:m_products,id',
            'supplier_id' => 'required|integer|exists:m_suppliers,id',
            'quantity' => 'required|integer|min:1',
            'purchase_price' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'purchase_date' => 'required|date|before_or_equal:today',
            'description' => 'nullable|string',
        ]);


        $productStockTransactionController = new ProductStockTransactionController();
        $productStockTransactionId = $productStockTransactionController->addStock($request->product_id, $request->quantity, $request->description);

        $request->merge(['transaction_stock_id' => $productStockTransactionId]);
        ProductPurchase::create($request->all());

        $product = Product::find($request->product_id);
        $product->increment('stock', $request->quantity);
        $product->save();

        $productName = $product->name;

        return redirect()->route('product_purchases.index')->with('success', 'Berhasil menambahkan pembelian ' . $productName . '.');
    }

    public function show(ProductPurchase $productPurchase)
    {
        return view('transactions.product_purchases.show', compact('productPurchase'));
    }
}
