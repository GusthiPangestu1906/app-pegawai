@extends('layouts.admin')

@section('title', 'Manajemen Departemen')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Data Departemen</h2>
        <a href="{{ route('departments.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Tambah Departemen
        </a>
    </div>

    <!-- Pemberitahuan untuk Admin -->
    <div class="mb-4 p-3 bg-blue-50 text-blue-700 text-sm rounded-lg border border-blue-100 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800 flex items-center gap-2">
        <i class="fa-solid fa-circle-info"></i>
        <span>Klik pada baris tabel untuk melihat detail departemen.</span>
    </div>

    <div class="bg-white dark:bg-dark-card rounded-lg shadow-sm overflow-hidden border border-gray-100 dark:border-dark-border">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-16">No</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Departemen</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($departments as $department)
                
                <!-- 1. Tambahkan onclick di sini untuk redirect ke halaman Show -->
                <!-- 2. Tambahkan class 'cursor-pointer' -->
                <tr onclick="window.location='{{ route('departments.show', $department->id) }}'" 
                    class="hover:bg-blue-50 dark:hover:bg-gray-700/50 transition duration-150 cursor-pointer group">
                    
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $loop->iteration }}</td>
                    
                    <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-gray-100">
                        {{ $department->name }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($department->description, 50) ?? '-' }}</td>
                    
                    <!-- 3. PENTING: Tambahkan onclick="event.stopPropagation()" di TD ini -->
                    <!-- Gunanya agar saat klik tombol Edit/Hapus, tidak malah pindah ke halaman Detail -->
                    <td class="px-6 py-4 text-right text-sm font-medium" onclick="event.stopPropagation()">
                        <div class="flex justify-end gap-2">
                            <!-- Tombol Mata dihapus karena seluruh baris sudah bisa diklik -->

                            <a href="{{ route('departments.edit', $department->id) }}" class="text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 hover:bg-indigo-100 p-2 rounded transition z-10 relative" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus departemen ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 p-2 rounded transition z-10 relative" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">Belum ada data departemen.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection