<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Product;
use App\Models\Master\ProductCategory;
use App\Models\Master\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'supplier')->get();
        return view('master.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        $suppliers = Supplier::all();
        return view('master.products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:m_products',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'required|exists:m_product_categories,id',
            'supplier_id' => 'nullable|exists:m_suppliers,id',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function show(Product $product)
    {
        return view('master.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        $suppliers = Supplier::all();
        return view('master.products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:m_products,code,' . $product->id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'required|exists:m_product_categories,id',
            'supplier_id' => 'nullable|exists:m_suppliers,id',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
