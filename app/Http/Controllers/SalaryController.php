<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\User;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query Gaji dengan relasi ke employee (User), jabatan, dan departemen
        $query = Salary::with(['employee.department', 'employee.position']);

        // Fitur Pencarian: Cari berdasarkan nama pegawai
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('employee', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        // Ambil data, urutkan terbaru, lalu KELOMPOKKAN berdasarkan Nama Departemen
        $groupedSalaries = $query->latest()->get()->groupBy(function($item) {
            return $item->employee->department->name ?? 'Tanpa Departemen';
        });

        return view('salaries.index', compact('groupedSalaries'));
    }

    public function create()
    {
        // Ambil SEMUA pegawai, dan sertakan data relasi yang dibutuhkan untuk pencarian
        $employees = User::where('role', 'employee')
                         ->with(['position', 'department', 'salary']) 
                         ->get();
                         
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:salaries,user_id',
            'base_salary' => 'required|numeric',
        ], [
            'user_id.unique' => 'Pegawai ini sudah memiliki data gaji! Silakan edit data yang ada.',
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

    /**
     * Approve the salary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, Salary $salary)
    {
        // NOTE: Make sure to run the migration to add the approval columns to the salaries table.
        // The migration file is: 2024_05_22_100000_add_approval_columns_to_salaries_table.php

        $salary->update([
            'approved_at' => now(),
            'approved_by' => auth()->id(),
        ]);

        return redirect()->route('salaries.show', $salary)->with('success', 'Gaji telah disetujui.');
    }
}