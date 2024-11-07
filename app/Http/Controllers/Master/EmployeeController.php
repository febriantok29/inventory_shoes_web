<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Employee;
use Illuminate\Http\Request;

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
            'email' => 'required|email|unique:m_employees',
            'contact_number' => 'nullable|string|max:15',
            'position' => 'required|string|max:255',
            'role' => 'required|in:admin,employee',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
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
            'email' => 'required|email|unique:m_employees,email,' . $employee->id,
            'contact_number' => 'nullable|string|max:15',
            'position' => 'required|string|max:255',
            'role' => 'required|in:admin,employee',
        ]);

        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
