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
        $salesTransactions = Sales::all();
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

        DB::beginTransaction();

        try {
            $totalItems = 0;
            $totalPrice = 0;

            foreach ($request->details as $detail) {
                $productDetail = ProductDetail::findOrFail($detail['product_detail_id']);
                $totalItems += $detail['quantity'];
                $totalPrice += $productDetail->price * $detail['quantity'];
            }

            if ($request->customer_money < $totalPrice) {
                return redirect()->back()
                    ->withErrors(['customer_money' => 'Insufficient customer money.'])
                    ->withInput();
            }

            $salesTransaction = Sales::create([
                'transaction_date' => $request->transaction_date,
                'total_items' => $totalItems,
                'total_price' => $totalPrice,
                'customer_money' => $request->customer_money,
                'change' => ($request->customer_money) - $totalPrice,
            ]);

            foreach ($request->details as $detail) {
                SalesDetail::create([
                    'sales_transaction_id' => $salesTransaction->id,
                    'product_detail_id' => $detail['product_detail_id'],
                    'quantity' => $detail['quantity'],
                ]);

                $productDetail = ProductDetail::findOrFail($detail['product_detail_id']);
                $productDetail->decrement('stock', $detail['quantity']);
            }

            DB::commit();

            return redirect()->route('sales.create')
                ->with('success', 'Transaction successfully saved.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while saving the transaction.'])
                ->withInput();
        }
    }

    public function show(string $id)
    {
        $salesTransaction = Sales::findOrFail($id);
        return view('transaction.sales.show', compact('salesTransaction'));
    }
}
