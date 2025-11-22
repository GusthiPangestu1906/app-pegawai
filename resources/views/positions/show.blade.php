@extends('layouts.admin')

@section('title', 'Detail Jabatan')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Detail Jabatan</h2>
            <a href="{{ route('positions.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-purple-50">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-purple-100 text-purple-600 rounded-lg">
                        <i class="fa-solid fa-briefcase text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $position->title }}</h3>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Gaji Dasar (Basic Salary)</label>
                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($position->basic_salary, 0, ',', '.') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Total Pegawai Menjabat</label>
                        <p class="text-2xl font-bold text-gray-900">{{ $position->users ? $position->users->count() : 0 }}</p>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t">
                    <a href="{{ route('positions.edit', $position->id) }}" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition shadow-sm inline-flex items-center">
                        <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Jabatan
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection