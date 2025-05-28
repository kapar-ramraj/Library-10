<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getEmployeeList(Request $request)
    {
        // dd($request->all(),$request->search);
        $query = Employee::query();
        if ($request->search) {
            $query->where('fname', 'like', '%' . $request->search . '%')
                ->orWhere('lname', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('designation', 'like', '%' . $request->search . '%');
        }
        $employees = $query->get(); // Employee::get();
        return view('employee.index', compact('employees'));
    }
    public function getEmployeeForm()
    {
        $employees = Employee::all(); // Employee::get();
        return view('employee.create', compact('employees'));
    }

    public function storeEmployee(Request $request)
    {
        // dd($request->all());
        Employee::create($request->all());

        return redirect()->route('employee.index')->with('success', 'Employee data stored successfully.');
    }

    public function deleteEmployee($id)
    {
        $Employee = Employee::findOrFail($id);
        $Employee->delete();
        return redirect()->back()->with('danger', 'Employee deleted successfully.');
    }

    public function editEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.edit', ['employee' => $employee]);
    }

    public function updateEmployee(Request $request, $id)
    {
        // dd($request->all(),$id);
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
    }
}
