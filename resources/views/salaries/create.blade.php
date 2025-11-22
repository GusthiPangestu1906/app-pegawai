@extends('layouts.admin')

@section('title', 'Input Gaji')

@section('content')
    <div class="max-w-4xl mx-auto">
         <!-- TAMPILKAN ERROR JIKA ADA -->
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
        
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800">Input Data Gaji Pegawai</h2>
                <p class="text-sm text-gray-500">Pastikan data pegawai dan periode gaji benar.</p>
            </div>

            <form action="{{ route('salaries.store') }}" method="POST" class="p-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Pilih Pegawai -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Pegawai</label>
                        <select name="user_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition bg-white" required>
                            <option value="">-- Cari Pegawai --</option>
                            <!-- Bagian ini sudah saya UN-COMMENT -->
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->name }} - {{ $emp->position->title ?? 'Tidak Ada Jabatan' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Gaji Pokok (Biasanya otomatis dari jabatan, tapi bisa diedit) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gaji Pokok</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                            <input type="number" name="base_salary" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" required>
                        </div>
                    </div>

                    <!-- Tunjangan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tunjangan</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                            <input type="number" name="allowance" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" value="0">
                        </div>
                    </div>

                    <!-- Bonus -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bonus</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                            <input type="number" name="bonus" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" value="0">
                        </div>
                    </div>

                    <!-- Potongan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Potongan</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                            <input type="number" name="deduction" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" value="0">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('salaries.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition shadow-sm">Simpan Gaji</button>
                </div>
            </form>
        </div>
    </div>
@endsection