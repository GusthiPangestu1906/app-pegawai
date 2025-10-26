@extends('master')

@section('title', 'Daftar Gaji')
@section('page-title', 'Manajemen Gaji')

@section('content')
<style>
    .table-container { padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .table-header h2 { margin: 0; font-size: 22px; }
    .btn-add { padding: 8px 15px; background-color: #0d6efd; color: white; text-decoration: none; border-radius: 5px; font-weight: 500; }
    .simple-table { width: 100%; border-collapse: collapse; }
    .simple-table th, .simple-table td { padding: 12px; text-align: left; border-bottom: 1px solid #e9ecef; }
    .simple-table thead th { background-color: #f8f9fa; font-weight: 600; color: #495057; }
    .action-links a, .action-links button { color: #0d6efd; text-decoration: none; margin-right: 10px; }
    .action-links button { background: none; border: none; cursor: pointer; padding: 0; font-family: inherit; font-size: 1em; }
    .action-links button.delete { color: #dc3545; }
</style>

<div class="table-container">
    <div class="table-header">
        <h2>Data Gaji Pegawai</h2>
        <a href="{{ route('salaries.create') }}" class="btn-add">Tambah Data</a>
    </div>

    <table class="simple-table">
        <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Bulan</th>
                <th>Gaji Pokok</th>
                <th>Total Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salaries as $salary)
                <tr>
                    <td>{{ $salary->employee->nama_lengkap }}</td>
                    <td>{{ $salary->bulan }}</td>
                    <td>Rp {{ number_format($salary->gaji_pokok, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($salary->gaji_pokok + $salary->tunjangan - $salary->potongan, 2, ',', '.') }}</td>
                    <td class="action-links">
                        <a href="{{ route('salaries.edit', $salary->id) }}">Edit</a>
                        <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete" onclick="return confirm('Yakin?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection