@extends('master')

@section('title', 'Tambah Pegawai')
@section('page-title', 'Tambah Pegawai')

@section('content')

{{-- CSS untuk Form Pegawai --}}
<style>
    /* Form Container */
    .form-container {
        max-width: 1000px;
        margin: 40px auto;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    /* Form Header */
    .form-header {
        background: #f8f9fa;
        padding: 2rem;
        border-bottom: 1px solid #e9ecef;
    }

    .form-header h1 {
        margin: 0;
        font-size: 1.75rem;
        color: #212529;
        font-weight: 600;
    }

    /* Form Content */
    .form-content {
        padding: 3rem;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem 3rem;
        margin-bottom: 1rem;
    }

    .form-group {
        margin-bottom: 2rem;
    }

    .form-group.full-width {
        grid-column: span 2;
    }

    /* Labels */
    .form-group label {
        display: block;
        margin-bottom: 0.75rem;
        font-weight: 500;
        color: #495057;
        font-size: 1rem;
    }

    /* Inputs */
    .form-control {
        width: 100%;
        padding: 0.875rem 1.25rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        transition: all 0.2s ease-in-out;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        outline: none;
    }

    /* Select */
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 16px 12px;
        padding-right: 2.5rem;
    }

    /* Textarea */
    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    /* Alerts */
    .alert {
        padding: 1.25rem;
        margin-bottom: 2rem;
        border-radius: 12px;
        border: 1px solid transparent;
        font-size: 1rem;
    }

    .alert-success {
        background-color: #e1f7e1;
        border-color: #c3e6cb;
        color: #198754;
    }

    .alert-danger {
        background-color: #fde8e8;
        border-color: #f5c6cb;
        color: #dc3545;
    }

    .alert ul {
        margin: 0;
        padding-left: 2rem;
    }

    /* Buttons */
    .btn-container {
        display: flex;
        justify-content: flex-end;
        gap: 1.5rem;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid #e9ecef;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 2rem;
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.5;
        text-align: center;
        text-decoration: none;
        vertical-align: middle;
        cursor: pointer;
        border-radius: 10px;
        transition: all 0.15s ease-in-out;
        gap: 0.75rem;
    }

    .btn-primary {
        color: #fff;
        background-color: #0d6efd;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        transform: translateY(-1px);
    }

    .btn-secondary {
        color: #495057;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }

    .btn-secondary:hover {
        background-color: #e9ecef;
        transform: translateY(-1px);
    }

    /* Required field indicator */
    .required::after {
        content: " *";
        color: #dc3545;
    }
    </style>
</head>
<body>

    <div class="form-container">
        <div class="form-header">
            <h1>{{ isset($employee) ? 'Edit Pegawai' : 'Tambah Pegawai Baru' }}</h1>
        </div>
        
        <div class="form-content">
            {{-- Alert Messages --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}" method="POST">
                @csrf
                @if(isset($employee))
                    @method('PUT')
                @endif
                
                <div class="form-grid">
                    {{-- Personal Information --}}
                    <div class="form-group">
                        <label for="nama_lengkap" class="required">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                               value="{{ old('nama_lengkap', $employee->nama_lengkap ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="required">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ old('email', $employee->email ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nomor_telepon" class="required">Nomor Telepon</label>
                        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" 
                               value="{{ old('nomor_telepon', $employee->nomor_telepon ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir" class="required">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" 
                               value="{{ old('tanggal_lahir', $employee->tanggal_lahir ?? '') }}" required>
                    </div>

                    {{-- Employment Information --}}
                    <div class="form-group">
                        <label for="departemen_id" class="required">Departemen</label>
                        <select class="form-control" id="departemen_id" name="departemen_id" required>
                            <option value="">-- Pilih Departemen --</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" 
                                    {{ old('departemen_id', $employee->departemen_id ?? '') == $department->id ? 'selected' : '' }}>
                                    {{ $department->nama_departemen }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jabatan_id" class="required">Jabatan</label>
                        <select class="form-control" id="jabatan_id" name="jabatan_id" required>
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}"
                                    {{ old('jabatan_id', $employee->jabatan_id ?? '') == $position->id ? 'selected' : '' }}>
                                    {{ $position->nama_jabatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_masuk" class="required">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" 
                               value="{{ old('tanggal_masuk', $employee->tanggal_masuk ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="status" class="required">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="aktif" {{ old('status', $employee->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $employee->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                            <option value="cuti" {{ old('status', $employee->status ?? '') == 'cuti' ? 'selected' : '' }}>Cuti</option>
                        </select>
                    </div>

                    {{-- Address (Full Width) --}}
                    <div class="form-group full-width">
                        <label for="alamat" class="required">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $employee->alamat ?? '') }}</textarea>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="btn-container">
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                        </svg>
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                            <path d="M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1zm11-3H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                        </svg>
                        {{ isset($employee) ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection