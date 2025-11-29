@extends('layouts.admin')

@section('title', 'Manajemen Gaji')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Data Penggajian</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Dikelompokkan berdasarkan Departemen Pegawai</p>
        </div>
        
        <div class="flex gap-2 w-full md:w-auto">
            <!-- Form Pencarian Nama Pegawai -->
            <form action="{{ route('salaries.index') }}" method="GET" class="relative w-full md:w-64">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pegawai..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition bg-white dark:bg-dark-card text-gray-900 dark:text-white placeholder-gray-400">
            </form>

            <a href="{{ route('salaries.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg shadow-sm transition flex items-center gap-2 whitespace-nowrap">
                <i class="fa-solid fa-plus"></i> <span class="hidden md:inline">Input Gaji</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-400 rounded-r shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Jika Hasil Pencarian Kosong -->
    @if($groupedSalaries->isEmpty())
        <div class="text-center py-12 bg-white dark:bg-dark-card rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                <i class="fa-solid fa-magnifying-glass text-2xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Data gaji tidak ditemukan</h3>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Coba cari dengan nama pegawai lain.</p>
            @if(request('search'))
                <a href="{{ route('salaries.index') }}" class="mt-4 inline-block text-green-600 hover:text-green-700 font-medium">Reset Pencarian</a>
            @endif
        </div>
    @else
        <div class="space-y-8">
            <!-- Loop per Departemen -->
            @foreach($groupedSalaries as $departmentName => $salaries)
                <div class="bg-white dark:bg-dark-card rounded-xl shadow-sm border border-gray-100 dark:border-dark-border overflow-hidden">
                    <!-- Header Departemen -->
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-dark-border flex items-center gap-3">
                        <div class="p-2 bg-white dark:bg-gray-700 rounded-lg shadow-sm text-green-600 dark:text-green-400">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ $departmentName }}</h3>
                        <span class="ml-auto text-xs font-semibold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 px-2 py-1 rounded-full">
                            {{ $salaries->count() }} Pegawai
                        </span>
                    </div>

                    <!-- Tabel Gaji -->
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-white dark:bg-dark-card border-b border-gray-100 dark:border-dark-border text-xs uppercase text-gray-500 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3 font-semibold w-16">No</th>
                                <th class="px-6 py-3 font-semibold">Pegawai</th>
                                <th class="px-6 py-3 font-semibold">Gaji Pokok</th>
                                <th class="px-6 py-3 font-semibold">Tunjangan</th>
                                <th class="px-6 py-3 font-semibold">Total Terima</th>
                                <th class="px-6 py-3 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($salaries as $index => $salary)
                            
                            <!-- Klik Baris untuk Lihat Detail Slip -->
                            <tr onclick="window.location='{{ route('salaries.show', $salary->id) }}'" 
                                class="hover:bg-green-50 dark:hover:bg-green-900/10 transition cursor-pointer group">
                                
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $loop->iteration }}</td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center">
                                             <!-- Cek apakah ada foto profil -->
                                                @if($salary->employee->profile_photo_path)
                                                    <img class="h-10 w-10 rounded-full object-cover border-2 border-gray-200 dark:border-gray-700 shadow-sm" src="{{ asset('storage/' . $salary->employee->profile_photo_path) }}" alt="{{ $salary->employee->name }}">
                                                @else
                                                    <!-- Jika tidak ada, tampilkan inisial -->
                                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-green-600 flex items-center justify-center text-white font-bold shadow-sm border-2 border-white dark:border-gray-700">
                                                        {{ substr($salary->employee->name, 0, 1) }}
                                                    </div>
                                                @endif
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-900 dark:text-gray-100 block">
                                                {{ $salary->employee->name ?? 'Unknown' }}
                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $salary->employee->position->title ?? '-' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                    Rp {{ number_format($salary->base_salary, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                    Rp {{ number_format($salary->allowance, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-green-600 dark:text-green-400">
                                    Rp {{ number_format(($salary->base_salary + $salary->allowance + $salary->bonus) - $salary->deduction, 0, ',', '.') }}
                                </td>
                                
                                <td class="px-6 py-4 text-right" onclick="event.stopPropagation()">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('salaries.edit', $salary->id) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition dark:text-indigo-400 dark:hover:bg-indigo-900/30" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data gaji ini?')">
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