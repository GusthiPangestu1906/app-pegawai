<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index() {
        $salaries = \App\Models\Salary::with('employee')->latest()->paginate(10);
        return view('salaries.index', compact('salaries'));
    }

    public function create() {
        $employees = \App\Models\Employee::all();
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request) {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);

        \App\Models\Salary::create($request->all());

        return redirect()->route('salaries.index');
    }

    public function edit(\App\Models\Salary $salary) {
        $employees = \App\Models\Employee::all();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, \App\Models\Salary $salary) {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);

        $salary->update($request->all());

        return redirect()->route('salaries.index');
    }

    public function destroy(\App\Models\Salary $salary) {
        $salary->delete();
        return redirect()->route('salaries.index');
    }
}
