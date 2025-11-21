<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Position;

class EmployeeController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');

        $query = Employee::with(['department', 'position']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('department', function ($dq) use ($search) {
                      $dq->where('nama_departemen', 'like', "%{$search}%");
                  })
                  ->orWhereHas('position', function ($pq) use ($search) {
                      $pq->where('nama_jabatan', 'like', "%{$search}%");
                  });
            });
        }

        $employees = $query->latest()->paginate(10)->withQueryString();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();

        return view('employees.create', compact('departments', 'positions'));
    }

    public function store(Request $request) {
    $request->validate([
        'nama_lengkap'  => 'required|string|max:255',
        'email'         => 'required|email|max:255',
        'nomor_telepon' => 'required|string|max:20',
        'tanggal_lahir' => 'required|date',
        'alamat'        => 'required|string|max:255',
        'tanggal_masuk' => 'required|date',
        'status'        => 'required|string|max:50',
        'departemen_id' => 'required|exists:departments,id',
        'jabatan_id'    => 'required|exists:positions,id',
    ]);

    // Normalisasi nilai status agar cocok dengan enum di database
    $rawStatus = trim($request->input('status'));
    $map = [
        'aktif' => 'aktif',
        'nonaktif' => 'nonaktif',
        'non-aktif' => 'nonaktif',
        'tidak aktif' => 'nonaktif',
        'tidakaktif' => 'nonaktif',
        'cuti' => 'cuti',
    ];

    $lower = mb_strtolower($rawStatus);
    $normalized = $map[$lower] ?? $lower;

    // Pastikan nilai yang dinormalisasi valid untuk enum
    if (! in_array($normalized, ['aktif','nonaktif','cuti'], true)) {
        return redirect()->back()->withInput()->with('error', 'Nilai status tidak valid. Pilih: Aktif, Non-Aktif, atau Cuti.');
    }

    $data = $request->all();
    $data['status'] = $normalized;

    Employee::create($data);

    return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    public function show(Employee $employee) {
        return view('employees.show', compact('employee'));
    }

    public function edit(string $id) {
        $employee = Employee::find($id);
        // ambil daftar departemen dan jabatan untuk select di form edit
        $departments = Department::all();
        $positions = Position::all();

        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status'        => 'required|string|max:50',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id'    => 'required|exists:positions,id',
        ]);

        // Normalisasi status seperti pada store
        $rawStatus = trim($request->input('status'));
        $map = [
            'aktif' => 'aktif',
            'nonaktif' => 'nonaktif',
            'non-aktif' => 'nonaktif',
            'tidak aktif' => 'nonaktif',
            'tidakaktif' => 'nonaktif',
            'cuti' => 'cuti',
        ];
        $lower = mb_strtolower($rawStatus);
        $normalized = $map[$lower] ?? $lower;

        if (! in_array($normalized, ['aktif','nonaktif','cuti'], true)) {
            return redirect()->back()->withInput()->with('error', 'Nilai status tidak valid. Pilih: Aktif, Non-Aktif, atau Cuti.');
        }

        $employee = Employee::findOrFail($id);
        $data = $request->all();
        $data['status'] = $normalized;
        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil diperbarui');
    }

    public function destroy(string $id) {
        $employee = Employee::find($id);
        $employee->delete();

        return redirect()->route('employees.index');
    }
}