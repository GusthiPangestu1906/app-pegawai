@extends('layouts.employee')

@section('title', 'Dashboard Pegawai')

@section('content')
    <div class="max-w-4xl mx-auto mt-6">

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-check-circle text-xl"></i>
                <div>
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-exclamation text-xl"></i>
                <div>
                    <p class="font-bold">Gagal!</p>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Tampilan Utama -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-indigo-600 p-6 text-white text-center">
                <h2 class="text-2xl font-bold">Presensi Hari Ini</h2>
                <p class="opacity-90">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
            </div>

            <div class="p-8">
                
                @if(!$attendance)
                    <!-- JIKA BELUM ABSEN SAMA SEKALI -->
                    
                    <!-- Pilihan Tab (Hadir / Izin / Sakit) -->
                    <div class="flex justify-center gap-4 mb-8" x-data="{ tab: 'hadir' }">
                        <!-- Kita gunakan JavaScript sederhana untuk switch tab -->
                        <script>
                            function showTab(tabName) {
                                document.getElementById('tab-hadir').classList.add('hidden');
                                document.getElementById('tab-izin').classList.add('hidden');
                                
                                document.getElementById('btn-hadir').classList.remove('bg-indigo-600', 'text-white');
                                document.getElementById('btn-hadir').classList.add('bg-gray-100', 'text-gray-600');
                                
                                document.getElementById('btn-izin').classList.remove('bg-yellow-500', 'text-white');
                                document.getElementById('btn-izin').classList.add('bg-gray-100', 'text-gray-600');

                                if(tabName === 'hadir') {
                                    document.getElementById('tab-hadir').classList.remove('hidden');
                                    document.getElementById('btn-hadir').classList.add('bg-indigo-600', 'text-white');
                                    document.getElementById('btn-hadir').classList.remove('bg-gray-100', 'text-gray-600');
                                } else {
                                    document.getElementById('tab-izin').classList.remove('hidden');
                                    document.getElementById('btn-izin').classList.add('bg-yellow-500', 'text-white');
                                    document.getElementById('btn-izin').classList.remove('bg-gray-100', 'text-gray-600');
                                }
                            }
                        </script>

                        <button id="btn-hadir" onclick="showTab('hadir')" class="px-6 py-2 rounded-full font-bold bg-indigo-600 text-white transition">
                            <i class="fa-regular fa-clock mr-2"></i> Hadir
                        </button>
                        <button id="btn-izin" onclick="showTab('izin')" class="px-6 py-2 rounded-full font-bold bg-gray-100 text-gray-600 hover:bg-yellow-100 transition">
                            <i class="fa-solid fa-envelope-open-text mr-2"></i> Sakit / Izin
                        </button>
                    </div>

                    <!-- FORM HADIR -->
                    <div id="tab-hadir">
                        <div class="text-center">
                            <div class="text-6xl font-bold text-gray-800 mb-2">{{ \Carbon\Carbon::now()->format('H:i') }}</div>
                            <p class="text-gray-500 mb-8">Waktu Server</p>
                            
                            <form action="{{ route('attendance.store') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold text-lg shadow-lg transition transform hover:-translate-y-1 flex justify-center items-center gap-3">
                                    <i class="fa-solid fa-fingerprint text-2xl"></i> ABSEN MASUK
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- FORM SAKIT / IZIN -->
                    <div id="tab-izin" class="hidden">
                        <form action="{{ route('attendance.store') }}" method="POST" class="max-w-lg mx-auto">
                            @csrf
                            
                            <div class="mb-6">
                                <label class="block text-gray-700 font-bold mb-2">Status Ketidakhadiran</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="status" value="sick" class="peer sr-only" required>
                                        <div class="p-4 rounded-lg border-2 border-gray-200 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 text-center hover:bg-gray-50 transition">
                                            <i class="fa-solid fa-briefcase-medical text-2xl text-yellow-500 mb-1"></i>
                                            <div class="font-bold text-gray-700">Sakit</div>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="status" value="permission" class="peer sr-only" required>
                                        <div class="p-4 rounded-lg border-2 border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 text-center hover:bg-gray-50 transition">
                                            <i class="fa-solid fa-file-contract text-2xl text-blue-500 mb-1"></i>
                                            <div class="font-bold text-gray-700">Izin</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 font-bold mb-2">Keterangan / Alasan</label>
                                <textarea name="note" rows="3" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-500 outline-none" placeholder="Contoh: Demam tinggi, ada urusan keluarga, dll..." required></textarea>
                            </div>

                            <button type="submit" class="w-full py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl font-bold shadow-md transition">
                                Kirim Pengajuan
                            </button>
                        </form>
                    </div>

                @elseif($attendance->status == 'present' && !$attendance->clock_out)
                    <!-- SUDAH MASUK, BELUM PULANG -->
                    <div class="text-center">
                        <div class="inline-block p-4 rounded-full bg-blue-50 text-blue-600 mb-4">
                            <i class="fa-solid fa-user-check text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Selamat Bekerja!</h3>
                        <p class="text-gray-500 mb-6">Anda masuk pada pukul <span class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') }}</span></p>

                        <form action="{{ route('attendance.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-4 bg-orange-500 hover:bg-orange-600 text-white rounded-xl font-bold text-lg shadow-lg transition transform hover:-translate-y-1 flex justify-center items-center gap-3">
                                <i class="fa-solid fa-person-walking-arrow-right"></i> ABSEN PULANG
                            </button>
                        </form>
                    </div>

                @else
                    <!-- SUDAH SELESAI / SUDAH IZIN / SAKIT -->
                    <div class="text-center">
                        @if($attendance->status == 'present')
                            <div class="inline-block p-4 rounded-full bg-green-100 text-green-600 mb-4">
                                <i class="fa-solid fa-check-double text-4xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-green-700 mb-1">Presensi Tuntas</h3>
                            <p class="text-gray-600">Jam Kerja: {{ \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') }} - {{ \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') }}</p>
                        @else
                            <div class="inline-block p-4 rounded-full bg-yellow-100 text-yellow-600 mb-4">
                                <i class="fa-solid fa-file-medical text-4xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-1">Status: {{ strtoupper($attendance->status) }}</h3>
                            <p class="text-gray-600 italic">"{{ $attendance->note }}"</p>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection