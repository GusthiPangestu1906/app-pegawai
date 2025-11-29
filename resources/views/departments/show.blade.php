@extends('layouts.admin')

@section('title', 'Detail Departemen')

@section('content')
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Detail Departemen</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Informasi lengkap struktur organisasi</p>
        </div>
        <a href="{{ route('departments.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- KOLOM KIRI: Info Utama (Tabel Jabatan SUDAH DIHAPUS) -->
        <div class="lg:col-span-1 space-y-8">
            
            <!-- Card 1: Info Departemen -->
            <div class="bg-white dark:bg-dark-card rounded-xl shadow-sm border border-gray-100 dark:border-dark-border overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-dark-border bg-blue-50 dark:bg-blue-900/20">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-200 rounded-lg">
                            <i class="fa-solid fa-building text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ $department->name }}</h3>
                            <span class="text-xs font-medium text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900/40 px-2 py-0.5 rounded-full">
                                ID: #{{ $department->id }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2">Deskripsi</h4>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6 text-sm">
                        {{ $department->description ?? 'Tidak ada deskripsi khusus untuk departemen ini.' }}
                    </p>

                    <h4 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2">Statistik</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-3 bg-gray-50 dark:bg-gray-700/30 rounded-lg text-center border border-gray-100 dark:border-gray-700">
                            <span class="block text-2xl font-bold text-gray-800 dark:text-white">{{ $department->positions->count() }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Jabatan</span>
                        </div>
                        <div class="p-3 bg-gray-50 dark:bg-gray-700/30 rounded-lg text-center border border-gray-100 dark:border-gray-700">
                            <span class="block text-2xl font-bold text-gray-800 dark:text-white">{{ $department->users->count() }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Pegawai</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-100 dark:border-dark-border">
                        <a href="{{ route('departments.edit', $department->id) }}" class="flex w-full justify-center items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition shadow-sm text-sm font-medium">
                            <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Departemen
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN: Daftar Pegawai (Kolom Email DIHAPUS & Link Detail Ditambahkan) -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-dark-card rounded-xl shadow-sm border border-gray-100 dark:border-dark-border overflow-hidden h-full">
                <div class="p-6 border-b border-gray-100 dark:border-dark-border flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-lg text-gray-800 dark:text-white">Daftar Pegawai</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Personil yang terdaftar di departemen ini</p>
                    </div>
                    <span class="bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-bold px-3 py-1 rounded-full border border-green-200 dark:border-green-800">
                        {{ $department->users->count() }} Orang
                    </span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 dark:bg-gray-800/50 text-gray-500 dark:text-gray-400 text-xs uppercase">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Pegawai</th>
                                <th class="px-6 py-3 font-semibold">Jabatan</th>
                                <!-- Kolom Email dihapus -->
                                <th class="px-6 py-3 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse($department->users as $user)
                                <!-- Klik baris untuk ke detail pegawai -->
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition cursor-pointer group" 
                                    onclick="window.location='{{ route('employees.show', $user->id) }}'">
                                    
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-9 w-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                                                <!-- Cek apakah ada foto profil -->
                                                @if($user->profile_photo_path)
                                                    <img class="h-10 w-10 rounded-full object-cover border-2 border-gray-200 dark:border-gray-700 shadow-sm" src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}">
                                                @else
                                                    <!-- Jika tidak ada, tampilkan inisial -->
                                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold shadow-sm border-2 border-white dark:border-gray-700">
                                                        {{ substr($user->name, 0, 1) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="font-medium text-gray-900 dark:text-gray-100 block">{{ $user->name }}</span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $user->id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                            {{ $user->position->title ?? '-' }}
                                        </span>
                                    </td>

                                    <!-- Tombol Lihat Detail -->
                                    <td class="px-6 py-4" onclick="event.stopPropagation()">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 border border-green-200 dark:border-green-800">
                                            Active
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-16 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="bg-gray-100 dark:bg-gray-800 rounded-full p-4 mb-3">
                                                <i class="fa-solid fa-user-group text-2xl text-gray-400 dark:text-gray-500"></i>
                                            </div>
                                            <p class="font-medium">Belum ada pegawai</p>
                                            <p class="text-xs mt-1">Pegawai dengan jabatan di departemen ini akan muncul di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection