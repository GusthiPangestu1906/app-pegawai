@extends('layouts.admin')

@section('title', 'Detail Pegawai')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header & Tombol Kembali -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Detail Pegawai</h2>
            <a href="{{ route('employees.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <!-- Cover / Header Profil -->
            <div class="bg-blue-600 p-6 text-white flex items-center gap-6">
                <div class="h-24 w-24 rounded-full bg-white text-blue-600 flex items-center justify-center text-3xl font-bold shadow-lg">
                    {{ substr($employee->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-2xl font-bold">{{ $employee->name }}</h3>
                    <p class="opacity-90">{{ $employee->email }}</p>
                    <div class="mt-2 inline-flex items-center px-3 py-1 rounded-full bg-blue-500 bg-opacity-50 text-sm border border-blue-400">
                        <span class="w-2 h-2 rounded-full bg-green-400 mr-2"></span> Active Employee
                    </div>
                </div>
            </div>

            <!-- Informasi Detail -->
            <div class="p-8">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Informasi Pribadi & Pekerjaan</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                        <p class="mt-1 text-gray-900 font-medium text-lg">{{ $employee->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Email</label>
                        <p class="mt-1 text-gray-900 font-medium text-lg">{{ $employee->email }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Departemen</label>
                        <p class="mt-1 text-gray-900 font-medium text-lg flex items-center gap-2">
                            <i class="fa-solid fa-building text-gray-400"></i>
                            {{ $employee->department->name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Jabatan</label>
                        <p class="mt-1 text-gray-900 font-medium text-lg flex items-center gap-2">
                            <i class="fa-solid fa-briefcase text-gray-400"></i>
                            {{ $employee->position->title ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Tanggal Lahir</label>
                        <p class="mt-1 text-gray-900 font-medium text-lg">
                            {{ $employee->birth_date ? \Carbon\Carbon::parse($employee->birth_date)->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Bergabung Sejak</label>
                        <p class="mt-1 text-gray-900 font-medium text-lg">
                            {{ $employee->created_at->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t flex gap-3">
                    <a href="{{ route('employees.edit', $employee->id) }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow-sm">
                        <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Data
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection