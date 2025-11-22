@extends('layouts.admin')

@section('title', 'Tambah Departemen')

@section('content')
    <div class="max-w-2xl mx-auto">
        
        <!-- --- TAMBAHKAN BLOK ERROR INI --- -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg shadow-sm">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <h3 class="font-bold">Gagal Menyimpan!</h3>
                </div>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- -------------------------------- -->

        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800">Buat Departemen Baru</h2>
            </div>

            <form action="{{ route('departments.store') }}" method="POST" class="p-6">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Departemen</label>
                    <!-- Tambahkan value="{{ old('name') }}" agar input tidak hilang saat error -->
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Contoh: IT, HRD, Marketing" required>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi <span class="text-gray-400 font-normal">(Opsional)</span></label>
                    <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Jelaskan fungsi departemen ini...">{{ old('description') }}</textarea>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('departments.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection