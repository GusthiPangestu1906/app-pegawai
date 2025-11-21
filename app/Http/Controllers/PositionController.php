<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::orderBy('created_at', 'asc')->paginate(10);
        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions,nama_jabatan',
            'gaji_pokok' => 'required|numeric|min:0',
        ], [
            'nama_jabatan.unique' => 'Nama jabatan sudah ada dalam database. Silakan gunakan nama yang berbeda.',
        ]);

        Position::create($request->all());

        return redirect()->route('positions.index');
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions,nama_jabatan,'.$position->id,
            'gaji_pokok' => 'required|numeric|min:0',
        ], [
            'nama_jabatan.unique' => 'Nama jabatan sudah ada dalam database. Silakan gunakan nama yang berbeda.',
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index');
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('positions.index');
    }
}