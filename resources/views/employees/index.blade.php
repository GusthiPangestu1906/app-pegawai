@extends('master')

{{-- Mengirimkan judul spesifik untuk tab browser dan header halaman --}}
@section('title', 'Daftar Pegawai')
@section('page-title', 'Manajemen Pegawai')

{{-- Ini adalah bagian konten utama yang akan dimasukkan ke @yield('content') di master layout --}}
@section('content')
<style>
    /* Kontainer utama untuk konten di dalam 'main' */
    .content-wrapper {
        padding: 25px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    /* Header di atas tabel (judul & tombol) */
    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #dee2e6;
    }
    .table-header h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 600;
        color: #2c3e50;
    }
    /* Tombol Tambah Data */
    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background-image: linear-gradient(45deg, #0d6efd 0%, #0a58ca 100%);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
    }
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(13, 110, 253, 0.4);
    }
    /* Tabel yang rapi */
    .simple-table {
        width: 100%;
        border-collapse: collapse;
    }
    .simple-table th, .simple-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e9ecef;
    }
    .simple-table thead th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
    }
    .simple-table tbody tr:hover {
        background-color: #f1f3f5;
    }
    /* Tombol dan link aksi di dalam tabel */
    .action-links a, .action-links button {
        color: #0d6efd;
        text-decoration: none;
        margin-right: 15px;
        font-weight: 500;
    }
    .action-links button {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        font-family: inherit;
        font-size: 1em;
    }
    .action-links button.delete {
        color: #dc3545;
    }
</style>

<div class="content-wrapper">
    <div class="table-header">
        <h2>Data Pegawai</h2>
        <a href="{{ route('employees.create') }}" class="btn-add">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
            </svg>
            <span>Tambah Data</span>
        </a>
    </div>

    <table class="simple-table">
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop untuk menampilkan setiap data pegawai --}}
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->nama_lengkap }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->nomor_telepon }}</td>
                    <td>{{ $employee->alamat }}</td>
                    <td>{{ $employee->status }}</td>
                    <td class="action-links">
                        <a href="{{ route('employees.show', $employee->id) }}">Detail</a>
                        <a href="{{ route('employees.edit', $employee->id) }}">Edit</a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

