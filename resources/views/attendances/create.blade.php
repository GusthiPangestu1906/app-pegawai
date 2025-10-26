@extends('master')
@section('title', 'Tambah Absensi')
@section('page-title', 'Tambah Absensi')

@section('content')
<style>
    .form-container { max-width: 600px; margin: auto; padding: 30px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-weight: 600; margin-bottom: 8px; }
    .form-group input, .form-group select { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
    .btn-submit { display: block; width: 100%; padding: 12px; background-color: #0d6efd; color: white; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; }
</style>

<div class="form-container">
    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="employee_id">Nama Pegawai</label>
            <select name="employee_id" id="employee_id" required>
                <option value="">-- Pilih Pegawai --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" required>
        </div>
        <div class="form-group">
            <label for="waktu_masuk">Waktu Masuk</label>
            <input type="time" name="waktu_masuk" id="waktu_masuk">
        </div>
        <div class="form-group">
            <label for="waktu_keluar">Waktu Keluar</label>
            <input type="time" name="waktu_keluar" id="waktu_keluar">
        </div>
        <div class="form-group">
            <label for="status_absensi">Status</label>
            <select name="status_absensi" id="status_absensi" required>
                <option value="hadir">Hadir</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
                <option value="alpha">Alpha</option>
            </select>
        </div>
        <button type="submit" class="btn-submit">Simpan</button>
    </form>
</div>
@endsection