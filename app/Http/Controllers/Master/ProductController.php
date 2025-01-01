<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Category;
use App\Models\Master\Product;
use App\Models\Master\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('details', 'category')->get();
        return view('master.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('master.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateProduct($request);

        $product = Product::create($validatedData);

        if ($request->has('details')) {
            $this->storeProductDetails($request->details, $product);
        }

        $product->update(['total_stock' => $product->details->sum('stock')]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        $product->load('details');
        return view('master.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $details = $product->details;
        return view('master.products.edit', compact('product', 'categories', 'details'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $this->validateProduct($request, $product->id);

        $details = $this->validateProductDetails($request)['details'];

        $product->update($validatedData);

        $this->updateProductDetails($details, $product);

        $product->update(['total_stock' => $product->details->sum('stock')]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    private function validateProduct(Request $request, $id = null)
    {
        $rules = [
            'code' => [
                'required',
                'string',
                'min:2',
                'max:16',
                'alpha_dash',
                Rule::unique('m_products', 'code')->ignore($id)->whereNull('deleted_at'),
            ],
            'name' => 'required|string|min:2|max:255',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:m_categories,id',
        ];

        return $request->validate($rules);
    }

    private function validateProductDetails(Request $request)
    {
        return $request->validate([
            'details.*.size' => 'required|string|max:10',
            'details.*.color' => 'required|string|max:20',
            'details.*.note' => 'nullable|string|max:255',
            'details.*.stock' => 'required|integer|min:0',
            'details.*.price' => 'required|numeric|min:0',
        ], [
            'details.*.size.required' => 'Ukuran harus diisi untuk setiap detail!',
            'details.*.color.required' => 'Warna harus diisi untuk setiap detail!',
            'details.*.stock.required' => 'Stok harus diisi untuk setiap detail!',
            'details.*.stock.min' => 'Stok tidak boleh kurang dari 0!',
            'details.*.price.required' => 'Harga harus diisi untuk setiap detail!',
            'details.*.price.min' => 'Harga tidak boleh kurang dari 0!',
        ]);
    }

    private function storeProductDetails(array $details, Product $product)
    {
        foreach ($details as $detail) {
            $product->details()->create($detail);
        }
    }

    private function updateProductDetails(array $details, Product $product)
    {
        $existingIds = $product->details()->pluck('id')->toArray();
        $incomingIds = collect($details)->pluck('id')->filter()->toArray();

        $toDelete = array_diff($existingIds, $incomingIds);
        if (!empty($toDelete)) {
            ProductDetail::whereIn('id', $toDelete)->delete();
        }

        foreach ($details as $detail) {
            if (isset($detail['id']) && in_array($detail['id'], $existingIds)) {
                ProductDetail::find($detail['id'])->update($detail);
            } else {
                $detail['product_id'] = $product->id;
                ProductDetail::create($detail);
            }
        }
    }
}