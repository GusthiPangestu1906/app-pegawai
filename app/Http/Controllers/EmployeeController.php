<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
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
        $positions = Position::with('department')->get();
        return view('employees.create', compact('positions'));
    }

    // PROSES SIMPAN DATA BARU
    public function store(Request $request)
    {
        $request->validate([
            // Tambahkan 'unique:users,name' agar nama tidak boleh sama
            'name' => 'required|string|max:255|unique:users,name',
            // Email sudah unik dari awal, tapi kita pastikan lagi
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'position_id' => 'required|exists:positions,id',
            'birth_date' => 'nullable|date',
        ], [
            // Pesan Error Kustom Bahasa Indonesia
            'name.unique' => 'Nama pegawai ini sudah terdaftar! Harap gunakan nama lain atau tambahkan inisial.',
            'email.unique' => 'Alamat email ini sudah digunakan oleh pegawai lain.',
        ]);

        // Cari data jabatan untuk mengisi department_id otomatis
        $position = Position::findOrFail($request->position_id);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employee',
            'position_id' => $request->position_id,
            'department_id' => $position->department_id,
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
            // Validasi unik dengan pengecualian ID sendiri (agar tidak error jika nama tidak diubah)
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'position_id' => 'required|exists:positions,id',
        ], [
            'name.unique' => 'Nama pegawai ini sudah terdaftar! Harap gunakan nama lain.',
            'email.unique' => 'Alamat email ini sudah digunakan oleh pegawai lain.',
        ]);

        $position = Position::findOrFail($request->position_id);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'position_id' => $request->position_id,
            'department_id' => $position->department_id,
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

    public function updatePhoto(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('photo')) {
            // 1. Hapus foto lama jika ada (agar tidak menuh-menuhin server)
            if ($user->profile_photo_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->profile_photo_path)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_photo_path);
            }

            // 2. Simpan foto baru
            $path = $request->file('photo')->store('profile-photos', 'public');
            
            // 3. Update database
            $user->update(['profile_photo_path' => $path]);
        }

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}