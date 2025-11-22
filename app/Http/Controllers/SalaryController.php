<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\User;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee')->latest()->get();
        return view('salaries.index', compact('salaries'));
    }

    public function create()
    {
        // Ambil hanya user dengan role employee
        $employees = User::where('role', 'employee')->get();
        return view('salaries.create', compact('employees'));
    }

    // PROSES SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'base_salary' => 'required|numeric',
        ]);

        Salary::create([
            'user_id' => $request->user_id,
            'base_salary' => $request->base_salary,
            'allowance' => $request->allowance ?? 0,
            'bonus' => $request->bonus ?? 0,
            'deduction' => $request->deduction ?? 0,
            'payment_date' => now(),
        ]);

        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil disimpan.');
    }

    public function edit(Salary $salary)
    {
        return view('salaries.edit', compact('salary'));
    }

    // PROSES UPDATE
    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'base_salary' => 'required|numeric',
        ]);

        $salary->update([
            'base_salary' => $request->base_salary,
            'allowance' => $request->allowance ?? 0,
            'bonus' => $request->bonus ?? 0,
            'deduction' => $request->deduction ?? 0,
        ]);

        return redirect()->route('salaries.index')->with('success', 'Data gaji diperbarui.');
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect()->route('salaries.index')->with('success', 'Data gaji dihapus.');
    }
    
    public function show(Salary $salary)
    {
        return view('salaries.show', compact('salary'));
    }
}