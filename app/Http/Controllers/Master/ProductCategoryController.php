<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        return view('master.product_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('master.product_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:m_product_categories|max:255',
            'description' => 'nullable|string',
        ]);

        ProductCategory::create($request->all());
        return redirect()->route('product_categories.index')->with('success', 'Product category created successfully.');
    }

    public function show(ProductCategory $productCategory)
    {
        return view('master.product_categories.show', compact('productCategory'));
    }

    public function edit(ProductCategory $productCategory)
    {
        return view('master.product_categories.edit', compact('productCategory'));
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name' => 'required|unique:m_product_categories,name,' . $productCategory->id,
            'description' => 'nullable|string',
        ]);

        $productCategory->update($request->all());
        return redirect()->route('product_categories.index')->with('success', 'Product category updated successfully.');
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return redirect()->route('product_categories.index')->with('success', 'Product category deleted successfully.');
    }
}
