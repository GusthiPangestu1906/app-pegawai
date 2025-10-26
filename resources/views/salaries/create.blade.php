@extends('master')
@section('title', 'Tambah Gaji')
@section('page-title', 'Tambah Data Gaji')

@section('content')
<style>
    .form-container { max-width: 600px; margin: auto; padding: 30px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-weight: 600; margin-bottom: 8px; }
    .form-group input, .form-group select { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
    .btn-submit { display: block; width: 100%; padding: 12px; background-color: #0d6efd; color: white; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; }
</style>

<div class="form-container">
    <form action="{{ route('salaries.store') }}" method="POST">
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
            <label for="bulan">Bulan (Contoh: 2025-10)</label>
            <input type="text" name="bulan" id="bulan" required>
        </div>
        <div class="form-group">
            <label for="gaji_pokok">Gaji Pokok</label>
            <input type="number" name="gaji_pokok" id="gaji_pokok" step="1000" required>
        </div>
        <div class="form-group">
            <label for="tunjangan">Tunjangan</label>
            <input type="number" name="tunjangan" id="tunjangan" step="1000" value="0">
        </div>
        <div class="form-group">
            <label for="potongan">Potongan</label>
            <input type="number" name="potongan" id="potongan" step="1000" value="0">
        </div>
        <button type="submit" class="btn-submit">Simpan</button>
    </form>
</div>
@endsection