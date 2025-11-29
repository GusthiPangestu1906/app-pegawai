@extends('layouts.admin')

@section('title', 'Manajemen Pegawai')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Data Pegawai</h2>
            <p class="text-gray-600 dark:text-gray-400 text-sm">Kelola data karyawan perusahaan Anda.</p>
        </div>
        <a href="{{ route('employees.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Tambah Pegawai
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white dark:bg-dark-card p-4 rounded-lg shadow-sm mb-6 border border-gray-100 dark:border-dark-border">
        <form action="{{ route('employees.index') }}" method="GET" class="flex gap-4">
            <div class="relative flex-1">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>
                <input type="text" name="search" placeholder="Cari nama, email, atau jabatan..." class="w-full border border-gray-300 dark:border-gray-600 rounded-lg pl-10 pr-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500" value="{{ request('search') }}">
            </div>
            <button type="submit" class="bg-gray-800 dark:bg-gray-700 text-white px-6 py-2 rounded-lg hover:bg-gray-900 dark:hover:bg-gray-600 transition shadow-sm">
                Cari
            </button>
        </form>
    </div>

    <!-- Info UX -->
    <div class="mb-4 p-3 bg-blue-50 text-blue-700 text-sm rounded-lg border border-blue-100 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800 flex items-center gap-2">
        <i class="fa-solid fa-circle-info"></i>
        <span>Klik pada baris tabel untuk melihat profil lengkap pegawai.</span>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-dark-card rounded-lg shadow-sm overflow-hidden border border-gray-100 dark:border-dark-border">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Lengkap</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Jabatan</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($employees as $employee)
                
                <tr onclick="window.location='{{ route('employees.show', $employee->id) }}'" 
                    class="hover:bg-blue-50 dark:hover:bg-gray-700/50 transition duration-150 cursor-pointer group">
                    
                    <!-- BAGIAN INI YANG DIPERBARUI -->
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <!-- Cek apakah ada foto profil -->
                            @if($employee->profile_photo_path)
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-gray-200 dark:border-gray-700 shadow-sm" src="{{ asset('storage/' . $employee->profile_photo_path) }}" alt="{{ $employee->name }}">
                            @else
                                <!-- Jika tidak ada, tampilkan inisial -->
                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold shadow-sm border-2 border-white dark:border-gray-700">
                                    {{ substr($employee->name, 0, 1) }}
                                </div>
                            @endif

                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $employee->name }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $employee->email }}</div>
                            </div>
                        </div>
                    </td>
                    <!-- SELESAI BAGIAN FOTO -->
                    
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                        <div class="flex flex-col">
                            <span class="font-medium text-gray-900 dark:text-gray-100">{{ $employee->position->title ?? '-' }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $employee->department->name ?? '-' }}</span>
                        </div>
                    </td>
                    
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 border border-green-200 dark:border-green-800">
                            Active
                        </span>
                    </td>
                    
                    <td class="px-6 py-4 text-right text-sm font-medium" onclick="event.stopPropagation()">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('employees.show', $employee->id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 bg-blue-50 dark:bg-blue-900/30 hover:bg-blue-100 dark:hover:bg-blue-900/50 p-2 rounded transition z-10 relative" title="Lihat Detail">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('employees.edit', $employee->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/30 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 p-2 rounded transition z-10 relative" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus pegawai ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 p-2 rounded transition z-10 relative" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fa-solid fa-folder-open text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                            <p class="text-lg font-medium">Belum ada data pegawai.</p>
                            <p class="text-sm text-gray-400 dark:text-gray-500">Silakan tambahkan pegawai baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection