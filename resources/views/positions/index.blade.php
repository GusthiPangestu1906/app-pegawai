@extends('layouts.admin')

@section('title', 'Manajemen Jabatan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Data Jabatan</h2>
        <a href="{{ route('positions.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg shadow-sm transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Tambah Jabatan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider w-16">No</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Departemen</th> <!-- Kolom Baru -->
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Jabatan</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Gaji Dasar</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($positions as $position)
                <tr class="hover:bg-purple-50 transition duration-150">
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-md text-xs font-bold">
                            {{ $position->department->name ?? 'Deleted' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $position->title }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">Rp {{ number_format($position->basic_salary ?? 0, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('positions.edit', $position->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-2 rounded transition" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus jabatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded transition" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data jabatan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection