<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Master\ProductDetail;
use App\Models\Transaction\Sales;
use App\Models\Transaction\SalesDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index()
    {
        $salesTransactions = Sales::with('details.productDetail')->get();
        return view('transaction.sales.index', compact('salesTransactions'));
    }

    public function create()
    {
        $productDetails = ProductDetail::with('product')->get();
        return view('transaction.sales.create', compact('productDetails'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_date' => 'required|date',
            'customer_money' => 'required|numeric|min:0',
            'details' => 'required|array|min:1',
            'details.*.product_detail_id' => 'required|exists:m_product_details,id',
            'details.*.quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $totalItems = 0;
            $totalPrice = 0;

            $details = collect($request->details)->map(function ($detail) use (&$totalItems, &$totalPrice) {
                $productDetail = ProductDetail::findOrFail($detail['product_detail_id']);
                $totalItems += $detail['quantity'];
                $totalPrice += $productDetail->price * $detail['quantity'];

                return [
                    'product_detail_id' => $productDetail->id,
                    'quantity' => $detail['quantity'],
                ];
            });

            if ($request->customer_money < $totalPrice) {
                abort(422, 'Uang pelanggan tidak mencukupi.');
            }

            $salesTransaction = Sales::create([
                'transaction_date' => $request->transaction_date,
                'total_items' => $totalItems,
                'total_price' => $totalPrice,
                'customer_money' => $request->customer_money,
                'change' => $request->customer_money - $totalPrice,
            ]);

            $details->each(function ($detail) use ($salesTransaction) {
                SalesDetail::create([
                    'sales_transaction_id' => $salesTransaction->id,
                    'product_detail_id' => $detail['product_detail_id'],
                    'quantity' => $detail['quantity'],
                ]);

                ProductDetail::findOrFail($detail['product_detail_id'])->decrement('stock', $detail['quantity']);
            });
        });

        return redirect()->route('sales.index')->with('success', 'Transaksi penjualan berhasil disimpan.');
    }

    public function show(string $id)
    {
        $salesTransaction = Sales::with('details.productDetail')->findOrFail($id);
        return view('transaction.sales.show', compact('salesTransaction'));
    }
}
