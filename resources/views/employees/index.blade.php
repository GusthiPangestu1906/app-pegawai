@extends('master')

{{-- Mengirimkan judul spesifik untuk tab browser dan header halaman --}}
@section('title', 'Daftar Pegawai')
@section('page-title', 'Manajemen Pegawai')

{{-- Ini adalah bagian konten utama yang akan dimasukkan ke @yield('content') di master layout --}}
@section('content')

{{-- CSS Khusus untuk halaman ini --}}
<style>
    /* Container styles */
    .container {
        padding: 2rem;
        background-color: #f8f9fa;
    }

    /* Card styles */
    .card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
    }

    /* Table styles */
    .styled-table {
        width: 100%;
        background: white;
        border-radius: 10px;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
    }

    .styled-table thead {
        background-color: #f8f9fa;
    }

    .styled-table th {
        padding: 1rem;
        font-weight: 600;
        color: #495057;
        text-align: left;
        border-bottom: 2px solid #e9ecef;
    }

    .styled-table td {
        padding: 1rem;
        border-bottom: 1px solid #e9ecef;
        color: #495057;
    }

    .styled-table tr:hover {
        background-color: #f8f9fa;
    }

    /* Badge untuk status */
    .status-badge {
        display: inline-block;
        padding: 0.4rem 0.8rem;
        font-size: 0.75rem;
        font-weight: 600;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 20px;
    }
    .status-aktif {
        background-color: #e1f7e1;
        color: #198754;
    }
    .status-nonaktif, .status-tidak-aktif {
        background-color: #fde8e8;
        color: #dc3545;
    }
    .status-cuti {
        background-color: #fff8e6;
        color: #976400;
    }

    /* Tombol aksi dengan ikon */
    .action-links {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .action-links a, .action-links button {
        color: #6c757d;
        text-decoration: none;
        transition: all 0.2s ease;
        padding: 8px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
    }
    .action-links button {
        border: none;
        cursor: pointer;
        font-family: inherit;
        font-size: 1em;
    }
    
    /* Efek hover untuk ikon aksi */
    .action-links a:hover {
        color: #0d6efd;
        background-color: #e7f0ff;
        transform: translateY(-1px);
    }
    .action-links button.delete:hover {
        color: #dc3545;
        background-color: #fff5f5;
        transform: translateY(-1px);
    }

    /* Header section */
    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .table-header h2 {
        font-size: 1.5rem;
        color: #1a1a1a;
        margin: 0;
    }

    /* Button styles */
    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #0d6efd;
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-add:hover {
        background-color: #0b5ed7;
        transform: translateY(-1px);
    }

    .btn-add svg {
        width: 20px;
        height: 20px;
    }

    /* Search bar styles */
    .table-filters {
        margin-bottom: 1.5rem;
    }

    .search-bar {
        position: relative;
        max-width: 500px;
    }

    .search-bar input {
        width: 100%;
        padding: 0.8rem 1rem 0.8rem 2.5rem;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background-color: white;
    }

    .search-bar input:focus {
        outline: none;
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }

    .search-bar svg {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        width: 20px;
        height: 20px;
    }

    /* Pagination styles */
    .pagination-links {
        margin-top: 1.5rem;
    }

    .pagination-links nav {
        display: flex;
        justify-content: center;
    }

    .pagination-links .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 5px;
    }

    .pagination-links .page-item .page-link {
        padding: 0.5rem 1rem;
        text-decoration: none;
        color: #495057;
        background-color: white;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .pagination-links .page-item.active .page-link {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }

    .pagination-links .page-item:hover:not(.active) .page-link {
        background-color: #f8f9fa;
        border-color: #0d6efd;
        color: #0d6efd;
    }

    .pagination-links .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #f8f9fa;
    }
</style>

{{-- Header Section with Title and Add Button --}}
<div class="table-header">
    <h2>Data Pegawai</h2>
    <a href="{{ route('employees.create') }}" class="btn-add">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
        </svg>
        <span>Tambah Pegawai</span>
    </a>
</div>

{{-- Search Bar --}}
<div class="table-filters">
    <form action="{{ route('employees.index') }}" method="GET" class="search-bar">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
        <input type="text" 
               name="search" 
               placeholder="Cari pegawai berdasarkan nama, email, departemen, atau jabatan..." 
               value="{{ request('search') }}"
               autocomplete="off">
    </form>
</div>

<table class="styled-table">
    <thead>
        <tr>
            <th>Nama Lengkap</th>
            <th>Departemen</th>
            <th>Jabatan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        {{-- Loop untuk menampilkan setiap data pegawai --}}
        @forelse ($employees as $employee)
            <tr>
                <td>{{ $employee->nama_lengkap }}</td>
                <td>{{ $employee->department->nama_departemen ?? 'N/A' }}</td>
                <td>{{ $employee->position->nama_jabatan ?? 'N/A' }}</td>
                
                {{-- Menggunakan badge status berwarna --}}
                <td>
                    {{-- Mengganti spasi dengan strip dan mengubah ke huruf kecil untuk nama kelas CSS --}}
                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $employee->status)) }}">
                        {{ $employee->status }}
                    </span>
                </td>
                
                {{-- Menggunakan ikon untuk Aksi --}}
                <td class="action-links">
                    <a href="{{ route('employees.show', $employee->id) }}" title="Detail">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg>
                    </a>
                    <a href="{{ route('employees.edit', $employee->id) }}" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete" onclick="return confirm('Anda yakin ingin menghapus data ini?')" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                            </svg>
                        </button>
                    </form>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 20px;">Belum ada data pegawai.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Link Paginasi --}}
<div class="pagination-links">
    {{ $employees->links() }}
</div>

@endsection

