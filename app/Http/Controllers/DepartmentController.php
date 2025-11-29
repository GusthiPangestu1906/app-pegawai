<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        // Use withCount to get the number of related users and positions
        $departments = Department::withCount(['users', 'positions'])->get();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
            'description' => 'nullable|string',
        ], [
            'name.unique' => 'Nama departemen ini sudah ada! Silakan gunakan nama lain.',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function show(Department $department)
    {
        // Load relasi 'positions' (jabatan)
        // Load relasi 'users' (pegawai) beserta 'position'-nya
        $department->load(['positions', 'users.position']);
        
        return view('departments.show', compact('department'));
    }


    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
            'description' => 'nullable|string',
        ], [
            'name.unique' => 'Nama departemen ini sudah ada! Silakan gunakan nama lain.',
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