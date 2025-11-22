<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::with('department')->get();
        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('positions.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            // Tambahkan 'unique:positions,title' agar nama jabatan tidak boleh sama
            'title' => 'required|string|max:255|unique:positions,title',
            'basic_salary' => 'required|numeric',
        ], [
            'title.unique' => 'Nama jabatan ini sudah ada! Tidak boleh duplikat.',
        ]);

        Position::create($request->all());

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit(Position $position)
    {
        $departments = Department::all();
        return view('positions.edit', compact('position', 'departments'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            // Unique dengan pengecualian ID saat ini
            'title' => 'required|string|max:255|unique:positions,title,' . $position->id,
            'basic_salary' => 'required|numeric',
        ], [
            'title.unique' => 'Nama jabatan ini sudah ada! Tidak boleh duplikat.',
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('positions.index')->with('success', 'Jabatan dihapus.');
    }
}