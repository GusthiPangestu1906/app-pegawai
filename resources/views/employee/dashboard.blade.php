@extends('layouts.employee')

@section('title', 'Dashboard Pegawai')

@section('content')
    <div class="max-w-3xl mx-auto mt-6">

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                <p class="font-bold">Gagal!</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Kartu Presensi -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-indigo-600 p-6 text-white text-center">
                <h2 class="text-2xl font-bold">Presensi Hari Ini</h2>
                <p class="opacity-90">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
            </div>

            <div class="p-8">
                <!-- Jam Display -->
                <div class="grid grid-cols-2 gap-6 mb-8 text-center">
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <span class="text-gray-500 text-sm font-semibold uppercase">Jam Masuk</span>
                        <div class="text-2xl font-bold text-indigo-600 mt-1">
                            {{ $attendance ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') : '--:--' }}
                        </div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <span class="text-gray-500 text-sm font-semibold uppercase">Jam Pulang</span>
                        <div class="text-2xl font-bold text-orange-600 mt-1">
                            {{ $attendance && $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') : '--:--' }}
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <form action="{{ route('attendance.store') }}" method="POST">
                    @csrf
                    
                    @if(!$attendance)
                        <!-- Tombol Masuk -->
                        <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold text-lg shadow-lg transition transform hover:-translate-y-1 flex justify-center items-center gap-3">
                            <i class="fa-regular fa-clock"></i> ABSEN MASUK
                        </button>
                    
                    @elseif(!$attendance->clock_out)
                        <!-- Tombol Pulang -->
                        <div class="text-center mb-6">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-medium">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                                Status: Sedang Bekerja
                            </span>
                        </div>
                        <button type="submit" class="w-full py-4 bg-orange-500 hover:bg-orange-600 text-white rounded-xl font-bold text-lg shadow-lg transition transform hover:-translate-y-1 flex justify-center items-center gap-3">
                            <i class="fa-solid fa-person-walking-arrow-right"></i> ABSEN PULANG
                        </button>
                    
                    @else
                        <!-- Selesai -->
                        <div class="bg-green-50 border border-green-200 rounded-xl p-6 text-center">
                            <i class="fa-solid fa-circle-check text-4xl text-green-500 mb-3"></i>
                            <h3 class="text-lg font-bold text-green-800">Presensi Tuntas!</h3>
                            <p class="text-green-600">Anda sudah menyelesaikan jam kerja hari ini.</p>
                        </div>
                    @endif
                </form>
            </div>
        </div>

    </div>
@endsection