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
            'size' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'product_category_id' => 'required|exists:m_product_categories,id',
            'supplier_id' => 'nullable|exists:m_suppliers,id',
        ]);

        $existedProduct = Product::withTrashed()->where('code', $request->code)->first();
        if ($existedProduct) {
            $existedProduct->restore();

            $existedProduct->update([
                'name' => $request->name,
                'size' => $request->size,
                'color' => $request->color,
                'price' => $request->price,
                'product_category_id' => $request->product_category_id,
                'supplier_id' => $request->supplier_id,
            ]);

            return redirect()->route('products.index')->with('success', 'Sepatu berhasil dipulihkan dan diperbarui.');
        }

        $request->merge(['stock' => 0]);
        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Sepatu berhasil ditambahkan.');
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
            'size' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'product_category_id' => 'required|exists:m_product_categories,id',
            'supplier_id' => 'nullable|exists:m_suppliers,id',
        ]);

        if (is_null($request->stock)) {
            $request->merge(['stock' => $product->stock]);
        }

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Berhasil memperbarui sepatu ' . $product->name . '.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Sepatu ' . $product->name . ' berhasil dihapus.');
    }
}
