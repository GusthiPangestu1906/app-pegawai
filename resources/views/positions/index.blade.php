@extends('layouts.admin')

@section('title', 'Manajemen Jabatan')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Data Jabatan</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Dikelompokkan berdasarkan Departemen</p>
        </div>
        
        <div class="flex gap-2 w-full md:w-auto">
            <!-- Form Pencarian -->
            <form action="{{ route('positions.index') }}" method="GET" class="relative w-full md:w-64">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari jabatan..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition bg-white dark:bg-dark-card text-gray-900 dark:text-white placeholder-gray-400">
            </form>

            <a href="{{ route('positions.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-lg shadow-sm transition flex items-center gap-2 whitespace-nowrap">
                <i class="fa-solid fa-plus"></i> <span class="hidden md:inline">Tambah</span>
            </a>
        </div>
    </div>

    <!-- Tampilkan Pesan Sukses -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-400 rounded-r shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Hasil Pencarian Kosong -->
    @if($groupedPositions->isEmpty())
        <div class="text-center py-12 bg-white dark:bg-dark-card rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                <i class="fa-solid fa-magnifying-glass text-2xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Data tidak ditemukan</h3>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Coba kata kunci pencarian lain.</p>
            @if(request('search'))
                <a href="{{ route('positions.index') }}" class="mt-4 inline-block text-purple-600 hover:text-purple-700 font-medium">Reset Pencarian</a>
            @endif
        </div>
    @else
        <div class="space-y-8">
            @foreach($groupedPositions as $departmentName => $positions)
                <!-- Card Per Departemen -->
                <div class="bg-white dark:bg-dark-card rounded-xl shadow-sm border border-gray-100 dark:border-dark-border overflow-hidden">
                    <!-- Header Departemen -->
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-dark-border flex items-center gap-3">
                        <div class="p-2 bg-white dark:bg-gray-700 rounded-lg shadow-sm text-purple-600 dark:text-purple-400">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ $departmentName }}</h3>
                        <span class="ml-auto text-xs font-semibold bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 px-2 py-1 rounded-full">
                            {{ $positions->count() }} Jabatan
                        </span>
                    </div>

                    <!-- Tabel Jabatan -->
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-white dark:bg-dark-card border-b border-gray-100 dark:border-dark-border text-xs uppercase text-gray-500 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3 font-semibold w-16">No</th>
                                <th class="px-6 py-3 font-semibold">Nama Jabatan</th>
                                <th class="px-6 py-3 font-semibold">Gaji Dasar</th>
                                <th class="px-6 py-3 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($positions as $index => $position)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition">
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-800 dark:text-gray-200">{{ $position->title }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                    Rp {{ number_format($position->basic_salary, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('positions.edit', $position->id) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition dark:text-indigo-400 dark:hover:bg-indigo-900/30" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus jabatan {{ $position->title }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition dark:text-red-400 dark:hover:bg-red-900/30" title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    @endif
@endsection