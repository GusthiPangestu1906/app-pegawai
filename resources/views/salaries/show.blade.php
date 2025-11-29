@extends('layouts.admin')

@section('title', 'Detail Gaji: ' . $salary->employee->name)

@push('styles')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #print-area, #print-area * {
            visibility: visible;
        }
        #print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none !important;
        }
    }
</style>
@endpush

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 no-print">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white">Detail Gaji Pegawai</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Rincian gaji untuk {{ $salary->employee->name }} pada periode ini.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('salaries.index') }}"
                class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center gap-2 text-sm font-medium shadow-sm">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center gap-2 text-sm font-medium shadow-sm">
                <i class="fa-solid fa-print"></i> Cetak Bukti
            </button>
        </div>
    </div>

    <div id="print-area" class="max-w-4xl mx-auto bg-white dark:bg-dark-card rounded-xl shadow-lg border border-gray-100 dark:border-dark-border overflow-hidden">
        <!-- Header Slip Gaji -->
        <div class="p-6 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-dark-border">
            <div class="flex flex-col sm:flex-row justify-between items-start">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">Slip Gaji</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Tanggal Pembayaran: {{ \Carbon\Carbon::parse($salary->payment_date)->isoFormat('D MMMM YYYY') }}
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 text-left sm:text-right">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">ID Transaksi</p>
                    <p class="text-sm font-bold text-gray-700 dark:text-gray-300">#SAL-{{ str_pad($salary->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
        </div>

        <!-- Info Pegawai -->
        <div class="p-6 border-b border-gray-100 dark:border-dark-border">
            <h4 class="text-base font-semibold text-gray-800 dark:text-white mb-4">Informasi Pegawai</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500 dark:text-gray-400">Nama Pegawai</p>
                    <p class="font-semibold text-gray-900 dark:text-white">{{ $salary->employee->name }}</p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400">Email</p>
                    <p class="font-semibold text-gray-900 dark:text-white">{{ $salary->employee->email }}</p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400">Jabatan</p>
                    <p class="font-semibold text-gray-900 dark:text-white">{{ $salary->employee->position->title ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400">Departemen</p>
                    <p class="font-semibold text-gray-900 dark:text-white">{{ $salary->employee->position->department->name ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Rincian Gaji -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Kolom Pendapatan -->
                <div>
                    <h4 class="text-base font-semibold text-green-600 dark:text-green-400 mb-4 border-b pb-2">Pendapatan</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">Gaji Pokok</span>
                            <span class="font-medium text-gray-800 dark:text-white">Rp {{ number_format($salary->base_salary, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">Tunjangan</span>
                            <span class="font-medium text-gray-800 dark:text-white">Rp {{ number_format($salary->allowance, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">Bonus</span>
                            <span class="font-medium text-gray-800 dark:text-white">Rp {{ number_format($salary->bonus, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-bold border-t pt-3 mt-3">
                            <span class="text-gray-800 dark:text-white">Total Pendapatan</span>
                            @php $total_earnings = $salary->base_salary + $salary->allowance + $salary->bonus; @endphp
                            <span class="text-gray-800 dark:text-white">Rp {{ number_format($total_earnings, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Kolom Potongan -->
                <div>
                    <h4 class="text-base font-semibold text-red-600 dark:text-red-400 mb-4 border-b pb-2">Potongan</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">Potongan Lainnya</span>
                            <span class="font-medium text-gray-800 dark:text-white">Rp {{ number_format($salary->deduction, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-bold border-t pt-3 mt-3">
                            <span class="text-gray-800 dark:text-white">Total Potongan</span>
                            <span class="text-gray-800 dark:text-white">Rp {{ number_format($salary->deduction, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Persetujuan & Aksi -->
        <div class="p-6 border-t border-gray-100 dark:border-dark-border">
            @if($salary->approved_at)
                <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg flex items-center gap-4">
                    <div class="text-green-500">
                        <i class="fa-solid fa-circle-check fa-2x"></i>
                    </div>
                    <div>
                        <p class="font-bold text-green-800 dark:text-green-300">Gaji Telah Disetujui</p>
                        <p class="text-sm text-green-700 dark:text-green-400">
                            Disetujui oleh <strong>{{ $salary->approvedBy->name ?? 'Admin' }}</strong> pada {{ \Carbon\Carbon::parse($salary->approved_at)->isoFormat('D MMMM YYYY, HH:mm') }}
                        </p>
                    </div>
                </div>
            @else
                <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg flex flex-col sm:flex-row items-center justify-between gap-4 no-print">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-exclamation text-yellow-500 fa-lg"></i>
                        <p class="font-semibold text-yellow-800 dark:text-yellow-300">Menunggu Persetujuan</p>
                    </div>
                    <form action="{{ route('salaries.approve', $salary->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menyetujui pencairan gaji ini?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-bold shadow-sm">Setujui Gaji</button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Total Gaji Bersih -->
        <div class="p-6 bg-green-50 dark:bg-green-900/30 border-t border-green-200 dark:border-green-800">
            <div class="flex justify-between items-center">
                <span class="text-lg font-bold text-green-700 dark:text-green-300">Gaji Bersih (Take Home Pay)</span>
                @php $net_salary = ($salary->base_salary + $salary->allowance + $salary->bonus) - $salary->deduction; @endphp
                <span class="text-2xl font-extrabold text-green-800 dark:text-green-200">Rp {{ number_format($net_salary, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
@endsection