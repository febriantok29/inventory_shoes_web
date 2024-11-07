<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transactions\DamagedProduct;
use Illuminate\Http\Request;

class DamagedProductController extends Controller
{
    public function index()
    {
        $damagedProducts = DamagedProduct::all();
        return view('transactions.damaged_products.index', compact('damagedProducts'));
    }

    public function create()
    {
        return view('transactions.damaged_products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'damage_description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'reported_date' => 'required|date',
        ]);

        DamagedProduct::create($request->all());
        return redirect()->route('damaged_products.index')->with('success', 'Damaged product recorded successfully.');
    }

    public function show(DamagedProduct $damagedProduct)
    {
        return view('transactions.damaged_products.show', compact('damagedProduct'));
    }

    public function edit(DamagedProduct $damagedProduct)
    {
        return view('transactions.damaged_products.edit', compact('damagedProduct'));
    }

    public function update(Request $request, DamagedProduct $damagedProduct)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'damage_description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'reported_date' => 'required|date',
        ]);

        $damagedProduct->update($request->all());
        return redirect()->route('damaged_products.index')->with('success', 'Damaged product updated successfully.');
    }

    public function destroy(DamagedProduct $damagedProduct)
    {
        $damagedProduct->delete();
        return redirect()->route('damaged_products.index')->with('success', 'Damaged product deleted successfully.');
    }
}
