@extends('master')

@section('title', 'Edit Departemen')
@section('page-title', 'Edit Departemen')

@section('content')
<style>
    :root{
        --bg: #ffffff;
        --primary: #0d6efd;
        --primary-dark: #0b5ed7;
        --input-border: #ccc;
        --radius: 8px;
        --radius-sm: 6px;
        --gap: 20px;
        --pad: 12px;
    }

    *, *::before, *::after { box-sizing: border-box; }

    .form-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px;
        background: var(--bg);
        border-radius: var(--radius);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .form-group { margin-bottom: var(--gap); }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"],
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: var(--pad);
        border: 1px solid var(--input-border);
        border-radius: var(--radius-sm);
        background: transparent;
        font: inherit;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(13,110,253,0.12);
    }

    .btn-submit {
        display: block;
        width: 100%;
        padding: var(--pad);
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: var(--radius-sm);
        font-size: 16px;
        cursor: pointer;
        transition: background .15s ease, transform .06s ease, box-shadow .12s ease;
    }

    .btn-submit:hover { background: var(--primary-dark); }
    .btn-submit:active { transform: translateY(1px); }
    .btn-submit:focus { box-shadow: 0 0 0 3px rgba(13,110,253,0.18); }
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

    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_departemen">Nama Departemen</label>
            <input type="text" id="nama_departemen" name="nama_departemen" value="{{ $department->nama_departemen }}" required>
        </div>
        <button type="submit" class="btn-submit">Update</button>
    </form>
</div>
@endsection