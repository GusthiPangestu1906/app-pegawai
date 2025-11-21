@extends('master')

@section('title', 'Edit Jabatan')
@section('page-title', 'Edit Jabatan')

@section('content')
<style>
    .form-container { max-width: 600px; margin: auto; padding: 30px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-weight: 600; margin-bottom: 8px; }
    .form-group input { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
    .btn-submit { display: block; width: 100%; padding: 12px; background-color: #0d6efd; color: white; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; }
</style>

<div class="form-container">
    @if ($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 20px; padding: 15px; border-radius: 4px; background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('positions.update', $position->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_jabatan">Nama Jabatan</label>
            <input type="text" id="nama_jabatan" name="nama_jabatan" value="{{ $position->nama_jabatan }}" required>
        </div>
         <div class="form-group">
            <label for="gaji_pokok">Gaji Pokok</label>
            <input type="number" id="gaji_pokok" name="gaji_pokok" value="{{ $position->gaji_pokok }}" step="1000" required>
        </div>
        <button type="submit" class="btn-submit">Update</button>
    </form>
</div>
@endsection