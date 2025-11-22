@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 dark:from-blue-800 dark:to-indigo-900 rounded-2xl shadow-lg p-8 mb-8 text-white flex justify-between items-center relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-3xl font-bold mb-2">Selamat Datang, Admin!</h2>
            <p class="text-blue-100 dark:text-gray-300 text-lg">Ringkasan aktivitas kepegawaian hari ini, {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}.</p>
        </div>
        <i class="fa-solid fa-chart-line text-9xl absolute -right-4 -bottom-8 text-white opacity-10"></i>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Card 1: Total Pegawai -->
        <div class="bg-white dark:bg-dark-card rounded-xl shadow-sm p-6 border-l-4 border-blue-500 hover:shadow-md transition transform hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Total Pegawai</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 dark:text-white mt-1">{{ $stats['employees'] }}</h3>
                </div>
                <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-blue-400">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card 2: Hadir Hari Ini -->
        <div class="bg-white dark:bg-dark-card rounded-xl shadow-sm p-6 border-l-4 border-green-500 hover:shadow-md transition transform hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Hadir Hari Ini</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 dark:text-white mt-1">{{ $stats['present_today'] }}</h3>
                </div>
                <div class="p-3 bg-green-50 dark:bg-green-900/30 rounded-lg text-green-600 dark:text-green-400">
                    <i class="fa-solid fa-user-check text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card 3: Izin / Sakit -->
        <div class="bg-white dark:bg-dark-card rounded-xl shadow-sm p-6 border-l-4 border-yellow-500 hover:shadow-md transition transform hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Izin / Sakit</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 dark:text-white mt-1">{{ $stats['absent_today'] }}</h3>
                </div>
                <div class="p-3 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg text-yellow-600 dark:text-yellow-400">
                    <i class="fa-solid fa-bed-pulse text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card 4: Departemen -->
        <div class="bg-white dark:bg-dark-card rounded-xl shadow-sm p-6 border-l-4 border-purple-500 hover:shadow-md transition transform hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Departemen</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 dark:text-white mt-1">{{ $stats['departments'] }}</h3>
                </div>
                <div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded-lg text-purple-600 dark:text-purple-400">
                    <i class="fa-solid fa-building text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Tabel Presensi Terbaru -->
        <div class="lg:col-span-2 bg-white dark:bg-dark-card rounded-xl shadow-sm border border-gray-100 dark:border-dark-border overflow-hidden">
            <div class="p-6 border-b border-gray-100 dark:border-dark-border flex justify-between items-center bg-gray-50 dark:bg-gray-800/50">
                <h3 class="font-bold text-gray-800 dark:text-white flex items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left text-indigo-500"></i> Aktivitas Terbaru
                </h3>
                <span class="text-xs text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 px-2 py-1 rounded">Realtime</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 dark:bg-gray-800/50 text-gray-500 dark:text-gray-400 text-xs uppercase">
                        <tr>
                            <th class="px-6 py-3 font-semibold">Pegawai</th>
                            <th class="px-6 py-3 font-semibold">Waktu</th>
                            <th class="px-6 py-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($recent_attendances as $attendance)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-xs uppercase">
                                        {{ substr($attendance->user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <span class="font-medium text-sm text-gray-900 dark:text-gray-100 block">{{ $attendance->user->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                @if($attendance->clock_out)
                                    <span class="text-xs font-bold text-orange-600 dark:text-orange-400">Pulang: {{ \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') }}</span>
                                @elseif($attendance->clock_in)
                                    <span class="text-xs font-bold text-blue-600 dark:text-blue-400">Masuk: {{ \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($attendance->status == 'present')
                                    <span class="px-2 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-semibold">Hadir</span>
                                @elseif($attendance->status == 'sick')
                                    <span class="px-2 py-1 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 text-xs font-semibold">Sakit</span>
                                @elseif($attendance->status == 'permission')
                                    <span class="px-2 py-1 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-semibold">Izin</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400 text-sm">
                                Belum ada aktivitas presensi hari ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white dark:bg-dark-card rounded-xl shadow-sm border border-gray-100 dark:border-dark-border p-6 h-fit">
            <h3 class="font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                <i class="fa-solid fa-bolt text-yellow-500"></i> Akses Cepat
            </h3>
            <div class="space-y-3">
                <a href="{{ route('employees.create') }}" class="flex items-center justify-between p-4 rounded-lg bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/40 group transition cursor-pointer border border-blue-100 dark:border-blue-800/30">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white dark:bg-blue-800 text-blue-600 dark:text-blue-300 rounded-lg shadow-sm group-hover:text-blue-700 dark:group-hover:text-blue-200 transition">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                        <span class="font-medium text-gray-700 dark:text-gray-200 group-hover:text-blue-700 dark:group-hover:text-blue-300">Tambah Pegawai</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-400 dark:text-gray-500 group-hover:text-blue-500 dark:group-hover:text-blue-400"></i>
                </a>

                <a href="{{ route('departments.create') }}" class="flex items-center justify-between p-4 rounded-lg bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/40 group transition cursor-pointer border border-green-100 dark:border-green-800/30">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white dark:bg-green-800 text-green-600 dark:text-green-300 rounded-lg shadow-sm group-hover:text-green-700 dark:group-hover:text-green-200 transition">
                            <i class="fa-solid fa-building-circle-check"></i>
                        </div>
                        <span class="font-medium text-gray-700 dark:text-gray-200 group-hover:text-green-700 dark:group-hover:text-green-300">Tambah Departemen</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-400 dark:text-gray-500 group-hover:text-green-500 dark:group-hover:text-green-400"></i>
                </a>

                <a href="{{ route('salaries.create') }}" class="flex items-center justify-between p-4 rounded-lg bg-orange-50 dark:bg-orange-900/20 hover:bg-orange-100 dark:hover:bg-orange-900/40 group transition cursor-pointer border border-orange-100 dark:border-orange-800/30">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white dark:bg-orange-800 text-orange-600 dark:text-orange-300 rounded-lg shadow-sm group-hover:text-orange-700 dark:group-hover:text-orange-200 transition">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </div>
                        <span class="font-medium text-gray-700 dark:text-gray-200 group-hover:text-orange-700 dark:group-hover:text-orange-300">Input Penggajian</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-400 dark:text-gray-500 group-hover:text-orange-500 dark:group-hover:text-orange-400"></i>
                </a>
            </div>
        </div>
    </div>
@endsection