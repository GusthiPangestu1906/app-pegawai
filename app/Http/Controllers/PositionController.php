<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Department; // Pastikan Model Department di-import
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        // Ambil data jabatan beserta info departemennya (eager loading)
        $positions = Position::with('department')->get();
        return view('positions.index', compact('positions'));
    }

    // --- PERBAIKAN DI SINI ---
    public function create()
    {
        // Ambil semua departemen untuk dropdown
        $departments = Department::all(); 
        
        // Kirim variabel $departments ke view
        return view('positions.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'title' => 'required|string|max:255',
            'basic_salary' => 'required|numeric',
        ]);

        Position::create($request->all());

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    // --- PERBAIKAN DI SINI JUGA ---
    public function edit(Position $position)
    {
        // Saat edit, kita juga butuh daftar departemen untuk dropdown
        $departments = Department::all();
        
        return view('positions.edit', compact('position', 'departments'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'title' => 'required|string|max:255',
            'basic_salary' => 'required|numeric',
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('positions.index')->with('success', 'Jabatan dihapus.');
    }
    
    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }
}