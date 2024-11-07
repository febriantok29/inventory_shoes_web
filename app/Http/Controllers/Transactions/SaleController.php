<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transactions\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::all();
        return view('transactions.sales.index', compact('sales'));
    }

    public function create()
    {
        return view('transactions.sales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sale_date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
        ]);

        Sale::create($request->all());
        return redirect()->route('sales.index')->with('success', 'Sale record created successfully.');
    }

    public function show(Sale $sale)
    {
        return view('transactions.sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        return view('transactions.sales.edit', compact('sale'));
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'sale_date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $sale->update($request->all());
        return redirect()->route('sales.index')->with('success', 'Sale record updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale record deleted successfully.');
    }
}
