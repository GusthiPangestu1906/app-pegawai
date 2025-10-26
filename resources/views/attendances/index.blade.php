@extends('master')

@section('title', 'Daftar Absensi')
@section('page-title', 'Manajemen Absensi')

@section('content')
<style>
    .content-wrapper { padding: 25px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
    .filter-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #dee2e6; }
    .filter-header h2 { margin: 0; font-size: 22px; color: #2c3e50; }
    .btn-add { display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; background-color: #0d6efd; color: white; text-decoration: none; border-radius: 6px; font-weight: 500; }
    .simple-table { width: 100%; border-collapse: collapse; }
    .simple-table th, .simple-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e9ecef; }
    .simple-table thead th { background-color: #f8f9fa; font-weight: 600; color: #495057; }
    .simple-table tbody tr:hover { background-color: #f1f3f5; }
    
    .status-badge { padding: 5px 10px; border-radius: 15px; font-size: 12px; font-weight: 600; text-transform: capitalize; }
    .status-hadir { background-color: #d1e7dd; color: #0f5132; }
    .status-sakit { background-color: #fff3cd; color: #664d03; }
    .status-izin { background-color: #cff4fc; color: #055160; }
    .status-alpha { background-color: #f8d7da; color: #842029; }

    .keterangan-terlambat { color: #dc3545; font-size: 12px; font-style: italic; }

    .action-links a, .action-links button { color: #6c757d; text-decoration: none; margin-right: 15px; font-weight: 500; }
    .action-links button { background: none; border: none; cursor: pointer; padding: 0; font-family: inherit; font-size: 1em; }
    .action-links a:hover, .action-links button:hover { color: #0d6efd; }
</style>

<div class="content-wrapper">
    <div class="filter-header">
        <h2>Data Absensi</h2>
        <a href="{{ route('attendances.create') }}" class="btn-add">Tambah Data Absensi</a>
    </div>

    <table class="simple-table">
        <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Tanggal</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Durasi Kerja</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->employee->nama_lengkap }}</td>
                    <td>{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d F Y') }}</td>
                    <td>
                        {{ $attendance->waktu_masuk ? \Carbon\Carbon::parse($attendance->waktu_masuk)->format('H:i') : '-' }}
                        @if($attendance->status_absensi == 'hadir' && $attendance->keterangan_terlambat == 'Terlambat')
                           <div class="keterangan-terlambat">(Terlambat)</div>
                        @endif
                    </td>
                    <td>{{ $attendance->waktu_keluar ? \Carbon\Carbon::parse($attendance->waktu_keluar)->format('H:i') : '-' }}</td>
                    <td>{{ $attendance->durasi_kerja }}</td>
                    <td>
                        <span class="status-badge status-{{ $attendance->status_absensi }}">
                            {{ $attendance->status_absensi }}
                        </span>
                    </td>
                    <td class="action-links">
                        <a href="{{ route('attendances.edit', $attendance->id) }}">Edit</a>
                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
