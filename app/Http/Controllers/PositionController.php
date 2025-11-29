<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query Position dengan relasi department
        $query = Position::with('department');

        // Jika ada parameter 'search', tambahkan filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhereHas('department', function($dept) use ($search) {
                      $dept->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        // Ambil data dan kelompokkan berdasarkan nama departemen
        $groupedPositions = $query->get()->groupBy(function($item) {
            return $item->department->name ?? 'Tanpa Departemen';
        });

        return view('positions.index', compact('groupedPositions'));
    }

    // ... (method create, store, edit, update, destroy biarkan sama seperti sebelumnya) ...
    
    public function create()
    {
        $departments = Department::all();
        return view('positions.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'title' => 'required|string|max:255|unique:positions,title,NULL,id,department_id,' . $request->department_id,
            'basic_salary' => 'required|numeric',
        ], [
            'title.unique' => 'Nama jabatan ini sudah ada di departemen tersebut!',
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
            'title' => 'required|string|max:255|unique:positions,title,' . $position->id . ',id,department_id,' . $request->department_id,
            'basic_salary' => 'required|numeric',
        ], [
            'title.unique' => 'Nama jabatan ini sudah ada di departemen tersebut!',
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