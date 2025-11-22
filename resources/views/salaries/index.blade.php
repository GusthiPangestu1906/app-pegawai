@extends('layouts.admin')

@section('title', 'Manajemen Gaji')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Data Penggajian</h2>
        <a href="{{ route('salaries.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-sm transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Input Gaji
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider w-16">No</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Pegawai</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Gaji Pokok</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Tunjangan</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($salaries as $salary)
                <tr class="hover:bg-green-50 transition duration-150">
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        {{ $salary->employee->name ?? 'Unknown' }}
                        <span class="block text-xs text-gray-500">{{ $salary->employee->position->title ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">Rp {{ number_format($salary->base_salary, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">Rp {{ number_format($salary->allowance, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-sm font-bold text-green-600">Rp {{ number_format($salary->base_salary + $salary->allowance, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('salaries.edit', $salary->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-2 rounded transition" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data gaji ini?')">
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
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data penggajian.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection