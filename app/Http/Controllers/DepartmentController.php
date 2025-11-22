<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    // --- UPDATE VALIDASI STORE ---
    public function store(Request $request)
    {
        $request->validate([
            // unique:nama_tabel,nama_kolom
            'name' => 'required|string|max:255|unique:departments,name',
            'description' => 'nullable|string',
        ], [
            // Custom pesan error
            'name.unique' => 'Nama departemen ini sudah ada! Silakan gunakan nama lain.',
            'name.required' => 'Nama departemen wajib diisi.',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    // --- UPDATE VALIDASI UPDATE ---
    public function update(Request $request, Department $department)
    {
        $request->validate([
            // unique:departments,name,ID_YANG_DIABAIKAN
            // Kita perlu mengecualikan ID departemen ini sendiri agar tidak error saat simpan diri sendiri
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
            'description' => 'nullable|string',
        ], [
            'name.unique' => 'Nama departemen ini sudah ada! Silakan gunakan nama lain.',
            'name.required' => 'Nama departemen wajib diisi.',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')->with('success', 'Departemen berhasil diperbarui.');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Departemen dihapus.');
    }
}