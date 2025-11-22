@extends('layouts.admin')

@section('title', 'Detail Departemen')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Detail Departemen</h2>
            <a href="{{ route('departments.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50">
                <h3 class="text-lg font-bold text-gray-800">{{ $department->name }}</h3>
            </div>
            
            <div class="p-6">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-500 mb-1">Deskripsi</label>
                    <p class="text-gray-900 text-lg leading-relaxed">{{ $department->description ?? 'Tidak ada deskripsi.' }}</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-500 mb-1">Jumlah Pegawai</label>
                    <p class="text-gray-900 text-2xl font-bold">{{ $department->users ? $department->users->count() : 0 }} <span class="text-sm font-normal text-gray-500">Orang</span></p>
                </div>

                <div class="mt-6 pt-6 border-t">
                    <a href="{{ route('departments.edit', $department->id) }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow-sm inline-flex items-center">
                        <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Departemen
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection