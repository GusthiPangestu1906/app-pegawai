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
    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_departemen">Nama Departemen</label>
            <input type="text" id="nama_departemen" name="nama_departemen" required>
        </div>
        <button type="submit" class="btn-submit">Simpan</button>
    </form>
</div>
@endsection