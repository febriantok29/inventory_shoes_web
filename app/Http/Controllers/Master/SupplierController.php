<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('master.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('master.suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:m_suppliers',
            'contact_number' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:m_suppliers',
            'address' => 'nullable|string',
        ]);

        $inputContactNumber = $request->contact_number;
        if ($inputContactNumber) {
            if (!preg_match('/^[0-9]*$/', $inputContactNumber)) {
                return redirect()->back()->withInput()->with('error', 'Nomor telepon hanya boleh berisi angka.');
            }

            // Cek apakah awalannya 0 atau 62
            if (substr($inputContactNumber, 0, 1) != '0' && substr($inputContactNumber, 0, 2) != '62') {
                return redirect()->back()->withInput()->with('error', 'Nomor telepon harus diawali dengan 0 atau 62.');
            }

            if (strlen($inputContactNumber) < 9 || strlen($inputContactNumber) > 15) {
                return redirect()->back()->withInput()->with('error', 'Nomor telepon harus memiliki panjang 9-15 karakter.');
            }
        }

        $lowerRequestCode = strtolower($request->code);
        $existingSupplier = Supplier::whereRaw('LOWER(code) = ?', $lowerRequestCode)->withTrashed()->first();

        if ($existingSupplier) {
            $existingSupplier->restore();

            $existingSupplier->update([
                'name' => $request->name,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'address' => $request->address,
            ]);

            return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dipulihkan dan diperbarui.');
        }

        Supplier::create($request->all());
        return redirect()->route('suppliers.index')->with('success', 'Berhasil menambahkan supplier baru.');
    }

    public function show(Supplier $supplier)
    {
        return view('master.suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('master.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|unique:m_suppliers,name,' . $supplier->id,
            'contact_number' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:m_suppliers,email,' . $supplier->id,
            'address' => 'nullable|string',
        ]);

        $supplier->update($request->all());
        return redirect()->route('suppliers.index')->with('success', 'Berhasil memperbarui data supplier.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplierName = $supplier->name;
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier ' . $supplierName . ' berhasil dihapus.');
    }
}
