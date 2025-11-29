@extends('layouts.admin')

@section('title', 'Detail Pegawai')

@section('content')
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Profil Pegawai</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Detail informasi karyawan</p>
        </div>
        <a href="{{ route('employees.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- KOLOM KIRI: Kartu Profil Utama & Upload Foto -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-dark-card rounded-2xl shadow-sm border border-gray-100 dark:border-dark-border overflow-hidden relative group">
                <!-- Banner Background -->
                <div class="h-32 bg-gradient-to-r from-blue-600 to-indigo-700 relative">
                    <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                        <!-- Foto Profil -->
                        <div class="relative">
                            @if($employee->profile_photo_path)
                                <img src="{{ asset('storage/' . $employee->profile_photo_path) }}" alt="{{ $employee->name }}" class="h-24 w-24 rounded-full border-4 border-white dark:border-dark-card object-cover shadow-md">
                            @else
                                <div class="h-24 w-24 rounded-full border-4 border-white dark:border-dark-card bg-white dark:bg-gray-800 flex items-center justify-center text-3xl font-bold text-indigo-600 shadow-md">
                                    {{ substr($employee->name, 0, 1) }}
                                </div>
                            @endif

                            <!-- Tombol Upload Foto (Muncul saat Hover) -->
                            <label for="photo-upload" class="absolute bottom-0 right-0 bg-gray-800 text-white p-1.5 rounded-full cursor-pointer hover:bg-gray-700 transition shadow-sm" title="Ubah Foto">
                                <i class="fa-solid fa-camera text-xs"></i>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Form Upload Tersembunyi -->
                <form id="photo-form" action="{{ route('employees.update-photo', $employee->id) }}" method="POST" enctype="multipart/form-data" class="hidden">
                    @csrf
                    @method('PATCH')
                    <input type="file" name="photo" id="photo-upload" accept="image/*" onchange="document.getElementById('photo-form').submit()">
                </form>
                
                <div class="pt-16 pb-6 px-6 text-center">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $employee->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $employee->email }}</p>
                    
                    <!-- Badge Status -->
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 border border-green-200 dark:border-green-800">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                        Active Employee
                    </span>

                    <div class="mt-6 flex justify-center gap-3">
                        <a href="{{ route('employees.edit', $employee->id) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-sm font-medium transition shadow-sm">
                            <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                        </a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus pegawai ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-white dark:bg-transparent border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 py-2 px-4 rounded-lg text-sm font-medium transition">
                                <i class="fa-solid fa-trash mr-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Card Info Login -->
            <div class="mt-6 bg-white dark:bg-dark-card rounded-xl shadow-sm border border-gray-100 dark:border-dark-border p-6">
                <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-shield-halved text-gray-400"></i> Akun & Keamanan
                </h4>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 dark:text-gray-400">Role Akses</span>
                        <span class="font-medium text-gray-900 dark:text-gray-200 capitalize">{{ $employee->role }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 dark:text-gray-400">Bergabung</span>
                        <span class="font-medium text-gray-900 dark:text-gray-200">{{ $employee->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: Detail Informasi -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Informasi Pekerjaan -->
            <div class="bg-white dark:bg-dark-card rounded-xl shadow-sm border border-gray-100 dark:border-dark-border overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-dark-border bg-gray-50 dark:bg-gray-800/50 flex items-center gap-2">
                    <i class="fa-solid fa-briefcase text-blue-500"></i>
                    <h4 class="font-bold text-gray-800 dark:text-white">Informasi Pekerjaan</h4>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
                    <div>
                        <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Departemen</label>
                        <div class="mt-1 flex items-center gap-2">
                            <div class="p-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg">
                                <i class="fa-solid fa-building"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $employee->department->name ?? '-' }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Divisi Utama</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Jabatan</label>
                        <div class="mt-1 flex items-center gap-2">
                            <div class="p-2 bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 rounded-lg">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $employee->position->title ?? '-' }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Posisi Saat Ini</p>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Status Penggajian</label>
                        <div class="mt-1 flex items-center gap-2">
                             @if($employee->salaries && $employee->salaries->isNotEmpty())
                                <div class="p-2 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 rounded-lg">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200">Sudah Pernah Digaji</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Pegawai ini memiliki riwayat penggajian dalam sistem.</p>
                                </div>
                            @else
                                <div class="p-2 bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400 rounded-lg">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200">Belum Pernah Digaji</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Tidak ada riwayat penggajian yang ditemukan.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Pribadi -->
            <div class="bg-white dark:bg-dark-card rounded-xl shadow-sm border border-gray-100 dark:border-dark-border overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-dark-border bg-gray-50 dark:bg-gray-800/50 flex items-center gap-2">
                    <i class="fa-solid fa-user text-green-500"></i>
                    <h4 class="font-bold text-gray-800 dark:text-white">Informasi Pribadi</h4>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Tanggal Lahir</label>
                        <p class="text-gray-900 dark:text-gray-200 font-medium flex items-center gap-2">
                            <i class="fa-regular fa-calendar text-gray-400"></i>
                            {{ $employee->birth_date ? \Carbon\Carbon::parse($employee->birth_date)->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Umur</label>
                        <p class="text-gray-900 dark:text-gray-200 font-medium">
                            {{ $employee->birth_date ? \Carbon\Carbon::parse($employee->birth_date)->age . ' Tahun' : '-' }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection