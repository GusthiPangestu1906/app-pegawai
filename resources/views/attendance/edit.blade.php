@extends('master')
@section('title', 'Edit Absensi')
@section('page-title', 'Edit Data Absensi')

@section('content')
<style>
    .form-container { max-width: 600px; margin: auto; padding: 30px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-weight: 600; margin-bottom: 8px; }
    .form-group input, .form-group select { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
    .btn-submit { display: block; width: 100%; padding: 12px; background-color: #0d6efd; color: white; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; }
</style>

<div class="form-container">
    <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="employee_id">Nama Pegawai</label>
            <select name="employee_id" id="employee_id" required>
                <option value="">-- Pilih Pegawai --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $attendance->employee_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ $attendance->tanggal }}" required>
        </div>
        <div class="form-group">
            <label for="waktu_masuk">Waktu Masuk</label>
            <input type="time" name="waktu_masuk" id="waktu_masuk" value="{{ $attendance->waktu_masuk }}">
        </div>
        <div class="form-group">
            <label for="waktu_keluar">Waktu Keluar</label>
            <input type="time" name="waktu_keluar" id="waktu_keluar" value="{{ $attendance->waktu_keluar }}">
        </div>
        <div class="form-group">
            <label for="status_absensi">Status</label>
            <select name="status_absensi" id="status_absensi" required>
                <option value="hadir" {{ $attendance->status_absensi == 'hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="izin" {{ $attendance->status_absensi == 'izin' ? 'selected' : '' }}>Izin</option>
                <option value="sakit" {{ $attendance->status_absensi == 'sakit' ? 'selected' : '' }}>Sakit</option>
                <option value="alpha" {{ $attendance->status_absensi == 'alpha' ? 'selected' : '' }}>Alpha</option>
            </select>
        </div>
        <button type="submit" class="btn-submit">Update Data</button>
    </form>
</div>
@endsection