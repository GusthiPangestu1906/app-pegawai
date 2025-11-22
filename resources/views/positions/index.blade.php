@extends('layouts.admin')

@section('title', 'Manajemen Jabatan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Data Jabatan</h2>
        <a href="{{ route('positions.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg shadow-sm transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Tambah Jabatan
        </a>
    </div>

    <div class="bg-white dark:bg-dark-card rounded-lg shadow-sm overflow-hidden border border-gray-100 dark:border-dark-border">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-16">No</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Departemen</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Jabatan</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Gaji Dasar</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($positions as $position)
                <tr class="hover:bg-purple-50 dark:hover:bg-gray-700/50 transition duration-150">
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                        <span class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-2 py-1 rounded-md text-xs font-bold border dark:border-gray-600">
                            {{ $position->department->name ?? 'Deleted' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $position->title }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">Rp {{ number_format($position->basic_salary ?? 0, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('positions.edit', $position->id) }}" class="text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 p-2 rounded transition">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus jabatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 p-2 rounded transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">Belum ada data jabatan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection