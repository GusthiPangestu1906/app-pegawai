@extends('layouts.admin')

@section('title', 'Detail Gaji')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Rincian Gaji</h2>
            <a href="{{ route('salaries.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            <!-- Header Slip -->
            <div class="bg-gray-800 text-white p-6 flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold">Slip Gaji Pegawai</h3>
                    <p class="text-gray-300 text-sm">ID Transaksi: #{{ $salary->id }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-400">Tanggal Cetak</p>
                    <p class="font-medium">{{ now()->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Info Pegawai -->
            <div class="p-6 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold text-lg">
                        {{ substr($salary->employee->name ?? 'U', 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 text-lg">{{ $salary->employee->name ?? 'Unknown' }}</h4>
                        <p class="text-gray-600 text-sm">{{ $salary->employee->position->title ?? '-' }} | {{ $salary->employee->department->name ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Rincian Angka -->
            <div class="p-8">
                <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Pendapatan</h4>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-gray-700">
                        <span>Gaji Pokok</span>
                        <span class="font-medium">Rp {{ number_format($salary->base_salary, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Tunjangan</span>
                        <span class="font-medium">Rp {{ number_format($salary->allowance, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Bonus</span>
                        <span class="font-medium text-green-600">+ Rp {{ number_format($salary->bonus, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="border-t border-dashed border-gray-300 my-4"></div>

                <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Potongan</h4>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-gray-700">
                        <span>Potongan Lain-lain</span>
                        <span class="font-medium text-red-600">- Rp {{ number_format($salary->deduction, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Total -->
                <div class="bg-green-50 rounded-lg p-4 border border-green-100 flex justify-between items-center mt-6">
                    <span class="font-bold text-green-800 text-lg">Total Gaji Bersih</span>
                    <span class="font-bold text-green-700 text-2xl">Rp {{ number_format(($salary->base_salary + $salary->allowance + $salary->bonus) - $salary->deduction, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="p-6 bg-gray-50 border-t border-gray-200 text-right">
                <a href="{{ route('salaries.edit', $salary->id) }}" class="px-6 py-2 border border-gray-300 bg-white text-gray-700 rounded-lg hover:bg-gray-100 transition mr-2">
                    Edit
                </a>
                <button onclick="window.print()" class="px-6 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition shadow-sm">
                    <i class="fa-solid fa-print mr-2"></i> Cetak Slip
                </button>
            </div>
        </div>
    </div>
@endsection