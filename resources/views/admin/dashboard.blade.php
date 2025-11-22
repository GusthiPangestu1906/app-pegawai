@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Welcome Banner -->
    <div class="bg-blue-600 rounded-lg shadow-lg p-6 mb-8 text-white flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold mb-2">Selamat Datang, Admin!</h2>
            <p class="opacity-90">Kelola data kepegawaian, departemen, dan penggajian dalam satu tempat.</p>
        </div>
        <i class="fa-solid fa-chart-line text-6xl opacity-20"></i>
    </div>

    <!-- Stats Grid (Isinya sama seperti sebelumnya) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- ... (Salin Card Stats dari file dashboard lama Anda kesini) ... -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500 hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Total Pegawai</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['employees'] ?? 0 }}</h3>
                </div>
                <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>
        <!-- ... dst ... -->
    </div>
@endsection