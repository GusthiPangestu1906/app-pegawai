@extends('layouts.admin')

@section('title', 'Edit Jabatan')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800">Edit Data Jabatan</h2>
            </div>

            <form action="{{ route('positions.update', $position->id) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
                <!-- Pilih Departemen -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Departemen</label>
                    <select name="department_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition bg-white" required>
                        <option value="">-- Pilih Departemen --</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ $dept->id == $position->department_id ? 'selected' : '' }}>
                                {{ $dept->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Jabatan</label>
                    <input type="text" name="title" value="{{ old('title', $position->title) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition" required>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gaji Dasar</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                        <input type="number" name="basic_salary" value="{{ old('basic_salary', $position->basic_salary) }}" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition" required>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('positions.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition shadow-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection