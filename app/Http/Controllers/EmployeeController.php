<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position; // Kita tidak butuh model Department lagi disini untuk dropdown
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    // Tampilkan Daftar Pegawai
    public function index(Request $request)
    {
        $query = User::where('role', 'employee')->with(['department', 'position']);

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $employees = $query->latest()->get();
        return view('employees.index', compact('employees'));
    }

    // Tampilkan Form Tambah
    public function create()
    {
        // Ambil jabatan beserta departemennya untuk ditampilkan di dropdown
        // Contoh tampilan nanti: "Senior Dev - IT", "Staff Admin - HRD"
        $positions = Position::with('department')->get();
        
        return view('employees.create', compact('positions'));
    }

    // PROSES SIMPAN DATA BARU
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'position_id' => 'required|exists:positions,id', // Wajib pilih jabatan
            'birth_date' => 'nullable|date',
        ]);

        // Cari data jabatan yang dipilih untuk mendapatkan department_id-nya
        $position = Position::findOrFail($request->position_id);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employee',
            'position_id' => $request->position_id,
            'department_id' => $position->department_id, // <--- OTOMATIS DISI DARI POSISI
            'birth_date' => $request->birth_date,
        ]);

        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    // Tampilkan Form Edit
    public function edit($id)
    {
        $employee = User::findOrFail($id);
        $positions = Position::with('department')->get();
        
        return view('employees.edit', compact('employee', 'positions'));
    }

    // PROSES UPDATE DATA
    public function update(Request $request, $id)
    {
        $employee = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'position_id' => 'required|exists:positions,id',
        ]);

        // Cari data jabatan baru (jika berubah)
        $position = Position::findOrFail($request->position_id);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'position_id' => $request->position_id,
            'department_id' => $position->department_id, // <--- UPDATE OTOMATIS
            'birth_date' => $request->birth_date,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil dihapus.');
    }
    
    public function show($id)
    {
        $employee = User::findOrFail($id);
        return view('employees.show', compact('employee'));
    }
}