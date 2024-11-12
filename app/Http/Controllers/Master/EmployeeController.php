<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('master.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('master.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:m_employees',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:m_employees',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'position' => 'required|string|max:255',
            'role' => 'required|in:admin,employee',
        ]);

        $generateCode = Employee::generateCode();

        Employee::create([
            'code' => $generateCode,
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'position' => $request->position,
            'role' => $request->role,
        ]);
        return redirect()->route('employees.index')->with('success', 'Berhasil menambahkan karyawan.');
    }

    public function show(Employee $employee)
    {
        return view('master.employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('master.employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:m_employees',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:m_employees',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'position' => 'required|string|max:255',
            'role' => 'required|in:admin,employee',
        ]);

        $employee->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'position' => $request->position,
            'role' => $request->role,
        ]);

        return redirect()->route('employees.index')->with('success', 'Berhasil memperbarui karyawan.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}
