<?php

namespace App\Http\Controllers\Transactions;

use Illuminate\Http\Request;
use App\Models\Master\Product;
use App\Http\Controllers\Controller;
use App\Models\Transactions\ProductStockTransaction;

class ProductStockTransactionController extends Controller
{
    const TYPE_PURCHASE = 'IN';
    const TYPE_SALE = 'OUT';

    public function index()
    {
        $stockTransactions = ProductStockTransaction::all();
        return view('transactions.product_stock.index', compact('stockTransactions'));
    }

    public function addPurchase(int $productId, int $quantity, string $note = null)
    {
        $product = Product::find($productId);

        if (!$product) {
            throw new \Exception('Sepatu tidak ditemukan.');
        }

        $productStockTransaction = new ProductStockTransaction();
        $productStockTransaction->product_id = $productId;
        $productStockTransaction->type = self::TYPE_PURCHASE;
        $productStockTransaction->quantity = $quantity;
        $productStockTransaction->description = $note;
        $productStockTransaction->save();

        $product->increment('stock', $quantity);
        $product->save();

        return $productStockTransaction->id;
    }

    public function addSale(int $productId, int $quantity, string $note = null)
    {
        $product = Product::find($productId);

        if ($product->stock < $quantity) {
            throw new \Exception('Stock ' . $product->name . ' tidak mencukupi, stock saat ini: ' . $product->stock);
        }

        $productStockTransaction = new ProductStockTransaction();
        $productStockTransaction->product_id = $productId;
        $productStockTransaction->type = self::TYPE_SALE;
        $productStockTransaction->quantity = $quantity;
        $productStockTransaction->description = $note;
        $productStockTransaction->save();

        $product->decrement('stock', $quantity);
        $product->save();

        return $productStockTransaction->id;
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:m_products,id',
            'type' => 'required|in:IN,OUT',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        ProductStockTransaction::create($request->all());

        return redirect()->route('product_stock_transactions.index')->with('success', 'Berhasil menambahkan stok sepatu.');
    }

    public function show(ProductStockTransaction $productStockTransaction)
    {
        return view('transactions.product_stock.show', compact('productStockTransaction'));
    }
}
