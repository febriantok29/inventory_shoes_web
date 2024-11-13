<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        // Cek apakah ada kategori produk dengan kode yang sama yang sudah dihapus
        $existingCategory = ProductCategory::withTrashed()->where('code', $request->code)->first();

        if ($existingCategory) {
            // Jika ada, pulihkan data yang dihapus
            $existingCategory->restore();

            // Update data yang ada dengan data baru dari form
            $existingCategory->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('product_categories.index')->with('success', 'Kategori produk berhasil dipulihkan dan diperbarui.');
        }

        // Jika tidak ada data yang cocok, buat data baru
        ProductCategory::create($request->all());

        return redirect()->route('product_categories.index')->with('success', 'Kategori produk berhasil ditambahkan.');
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
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        // Update data kategori produk
        $productCategory->update($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('product_categories.index')->with('success', 'Kategori produk berhasil diperbarui.');
    }

    public function destroy(ProductCategory $productCategory)
    {
        // Hapus kategori produk
        $productCategory->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('product_categories.index')->with('success', 'Kategori produk berhasil dihapus.');
    }
}
