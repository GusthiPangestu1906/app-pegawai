@extends('master')

@section('title', 'Daftar Departemen')
@section('page-title', 'Manajemen Departemen')

@section('content')
<style>
    :root{
        --primary: #0d6efd;
        --danger: #dc3545;
        --bg: #ffffff;
        --muted: #f8f9fa;
        --border: #e9ecef;
        --text: #495057;
        --radius: 8px;
        --pad: 16px;
        --shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    /* Container */
    .table-container {
        padding: calc(var(--pad) + 4px);
        background: var(--bg);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: auto;
    }

    /* Header */
    .table-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 18px;
    }
    .table-header h2 {
        margin: 0;
        font-size: 20px;
        color: var(--text);
        font-weight: 600;
    }

    /* Add button */
    .btn-add{
        display: inline-block;
        padding: 8px 14px;
        background: var(--primary);
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        transition: background .15s ease, transform .08s ease;
    }
    .btn-add:hover{ background: color-mix(in srgb, var(--primary) 85%, black 15%); transform: translateY(-1px); }

    /* Table */
    .simple-table{
        width: 100%;
        border-collapse: collapse;
        min-width: 560px;
    }
    .simple-table thead th{
        background: var(--muted);
        color: var(--text);
        font-weight: 600;
        text-align: left;
        padding: 12px;
        border-bottom: 1px solid var(--border);
    }
    .simple-table th, .simple-table td{
        padding: 12px;
        vertical-align: middle;
        border-bottom: 1px solid var(--border);
        color: var(--text);
    }
    .simple-table tbody tr:hover{
        background: rgba(13,110,253,0.03);
    }

    /* Actions */
    .action-links{
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .action-links a{
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
    }
    .action-links a:hover{ text-decoration: underline; }

    .action-links button{
        background: none;
        border: none;
        padding: 0;
        margin: 0;
        color: var(--primary);
        cursor: pointer;
        font: inherit;
    }
    .action-links button.delete{
        color: var(--danger);
    }
    .action-links button:focus, .action-links a:focus, .btn-add:focus{
        outline: 3px solid rgba(13,110,253,0.12);
        outline-offset: 2px;
        border-radius: 6px;
    }

    /* Responsive tweaks */
    @media (max-width: 640px){
        .table-header { flex-direction: column; align-items: stretch; gap: 10px; }
        .simple-table { font-size: 14px; }
    }
</style>

<div class="table-container">
    <div class="table-header">
        <h2>Data Departemen</h2>
        <a href="{{ route('departments.create') }}" class="btn-add">Tambah Data</a>
    </div>

    <table class="simple-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Departemen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
                <tr>
                    <td>{{ ($departments->currentPage() - 1) * $departments->perPage() + $loop->iteration }}</td>
                    <td>{{ $department->nama_departemen }}</td>
                    <td class="action-links">
                        <a href="{{ route('departments.edit', $department->id) }}">Edit</a>
                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;">
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