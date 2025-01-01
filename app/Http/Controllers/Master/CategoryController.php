<?php

namespace App\Http\Controllers\Master;

use App\Models\Master\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $categories = Category::all();
        return view('master.categories.index', compact('categories'));
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('master.categories.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $validatedData = $this->validateCategory($request);

        $existingCategory = Category::withTrashed()->where('code', $validatedData['code'])->first();

        if ($existingCategory) {
            $existingCategory->restore();
            $existingCategory->update($validatedData);

            return redirect()->route('categories.index')->with('success', 'Kategori ' . $validatedData['name'] . ' berhasil diaktifkan kembali.');
        }

        Category::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Kategori ' . $validatedData['name'] . ' berhasil ditambahkan.');
    }

    // Menampilkan detail kategori
    public function show(Category $category)
    {
        return view('master.categories.show', compact('category'));
    }

    // Menampilkan form untuk mengedit kategori
    public function edit(Category $category)
    {
        return view('master.categories.edit', compact('category'));
    }

    // Memperbarui kategori
    public function update(Request $request, Category $category)
    {
        $validatedData = $this->validateCategory($request, $category->id);
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Kategori ' . $validatedData['name'] . ' berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }

    private function validateCategory(Request $request, $id = null)
    {
        $rules = [
            'code' => [
                'required',
                'string',
                'min:2',
                'max:16',
                'alpha_dash',
                Rule::unique('m_categories', 'code')->ignore($id)->whereNull('deleted_at'),
            ],
            'name' => 'required|string|min:2|max:255',
        ];

        $messages = [
            'code.required' => 'Kode kategori harus diisi!',
            'code.unique' => 'Kode kategori sudah digunakan, silakan gunakan kode lain.',
            'code.min' => 'Silakan masukkan minimal 2 karakter untuk kode kategori.',
            'code.max' => 'Silakan masukkan maksimal 16 karakter untuk kode kategori.',
            'code.alpha_dash' => 'Kode kategori hanya boleh berisi huruf, angka, strip, dan underscore.',
            'name.required' => 'Nama kategori harus diisi!',
            'name.min' => 'Silakan masukkan minimal 2 karakter untuk nama kategori.',
            'name.max' => 'Silakan masukkan maksimal 255 karakter untuk nama kategori.',
        ];

        return $request->validate($rules, $messages);
    }
}
