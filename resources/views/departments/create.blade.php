@extends('master')

@section('title', 'Tambah Departemen')
@section('page-title', 'Tambah Departemen')

@section('content')
<style>
    :root {
        --max-width: 600px;
        --padding: 30px;
        --bg: #ffffff;
        --card-radius: 8px;
        --shadow: 0 4px 10px rgba(0,0,0,0.1);
        --border: #ccc;
        --primary: #0d6efd;
        --text-white: #ffffff;
        --input-padding: 12px;
        --btn-font-size: 16px;
    }

    *, *::before, *::after {
        box-sizing: border-box;
    }

    .form-container {
        max-width: var(--max-width);
        margin: 0 auto;
        padding: var(--padding);
        background: var(--bg);
        border-radius: var(--card-radius);
        box-shadow: var(--shadow);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .form-group input {
        width: 100%;
        padding: var(--input-padding);
        border: 1px solid var(--border);
        border-radius: 6px;
        font: inherit;
    }

    .form-group input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(13,110,253,0.12);
    }

    .btn-submit {
        display: block;
        width: 100%;
        padding: var(--input-padding);
        background-color: var(--primary);
        color: var(--text-white);
        border: none;
        border-radius: 6px;
        font-size: var(--btn-font-size);
        cursor: pointer;
    }

    .btn-submit:hover {
        filter: brightness(0.95);
    }

    @media (max-width: 480px) {
        .form-container {
            padding: 20px;
        }
    }
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

    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 20px; padding: 15px; border-radius: 4px; background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_departemen">Nama Departemen</label>
            <input type="text" id="nama_departemen" name="nama_departemen" value="{{ old('nama_departemen') }}" required placeholder="Masukkan Nama Departemen">
        </div>
        <button type="submit" class="btn-submit">Simpan</button>
    </form>
</div>
@endsection