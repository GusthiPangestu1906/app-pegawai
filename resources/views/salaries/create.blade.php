@extends('layouts.admin')

@section('title', 'Input Gaji')

@section('content')
    <!-- Header with Back Button -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Input Gaji Baru</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Formulir penggajian yang sederhana dan profesional.</p>
        </div>
        <a href="{{ route('salaries.index') }}" class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center gap-2 text-sm font-medium shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="max-w-4xl mx-auto">
        
        <!-- Tampilkan Error Validasi -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 text-red-700 dark:text-red-400 rounded-r shadow-sm">
                <div class="flex items-center gap-2 mb-1">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span class="font-bold">Terdapat Kesalahan Input:</span>
                </div>
                <ul class="list-disc list-inside text-sm ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white dark:bg-dark-card rounded-xl shadow-lg border border-gray-100 dark:border-dark-border overflow-hidden">
            
            <!-- Form Header -->
            <div class="p-6 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-dark-border flex items-start gap-4">
                <div class="p-3 bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-lg">
                    <i class="fa-solid fa-money-check-dollar text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">Formulir Penggajian</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Silakan isi komponen gaji di bawah ini dengan teliti.</p>
                </div>
            </div>

            <form action="{{ route('salaries.store') }}" method="POST">
                @csrf
                
                <div class="p-8 space-y-8">
                    <!-- Section 1: Pegawai (Pencarian Interaktif) -->
                    <div>
                        <h4 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 pb-2 flex items-center gap-2">
                            <span class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full w-5 h-5 flex items-center justify-center text-[10px]">1</span>
                            Pilih Pegawai
                        </h4>

                        <div class="relative mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Cari Pegawai <span class="text-red-500">*</span>
                            </label>

                            <!-- Input Pencarian -->
                            <div class="relative">
                                <i class="fa-solid fa-search absolute left-4 top-3.5 text-gray-400"></i>
                                <input type="text" id="search-input" placeholder="Ketik nama atau email pegawai..." 
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition bg-white dark:bg-gray-700 text-gray-900 dark:text-white" autocomplete="off">
                            </div>

                            <!-- Hidden Input untuk menyimpan ID pegawai yang dipilih -->
                            <input type="hidden" name="user_id" id="selected-user-id" value="{{ old('user_id') }}" required>

                            <!-- Tampilan Pegawai Yang Dipilih -->
                            <div id="selected-user-display" class="mt-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 text-sm text-gray-500 dark:text-gray-400">
                                <i class="fa-solid fa-user-tag mr-2"></i> Pegawai terpilih: <span id="selected-name" class="font-semibold text-gray-800 dark:text-white">-- Belum Dipilih --</span>
                            </div>

                        </div>

                        <!-- Daftar Pegawai (Hasil Pencarian) - Awalnya tersembunyi -->
                        <div id="employee-list-container" class="max-h-64 overflow-y-auto border border-gray-300 dark:border-gray-600 rounded-lg shadow-inner bg-white dark:bg-gray-800" style="display: none;">
                            <!-- Konten diisi oleh JavaScript -->
                        </div>

                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 flex items-center gap-1">
                            <i class="fa-solid fa-info-circle text-blue-500"></i> 
                            Data gaji pegawai yang sudah diinput tetap ditampilkan di daftar.
                        </p>
                    </div>

                    <!-- Section 2: Komponen Gaji (Disederhanakan) -->
                    <div>
                        <h4 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 pb-2 flex items-center gap-2">
                            <span class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full w-5 h-5 flex items-center justify-center text-[10px]">2</span>
                            Rincian Nominal
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Gaji Pokok -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Gaji Pokok <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 dark:text-gray-400 font-bold">Rp</span>
                                    <input type="number" name="base_salary" value="{{ old('base_salary') }}" class="w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 font-medium" placeholder="0" required>
                                </div>
                            </div>

                            <!-- Tunjangan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tunjangan
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 dark:text-gray-400 font-bold">Rp</span>
                                    <input type="number" name="allowance" value="{{ old('allowance') }}" class="w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400" placeholder="0">
                                </div>
                            </div>

                            <!-- Bonus -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Bonus
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 dark:text-gray-400 font-bold">Rp</span>
                                    <input type="number" name="bonus" value="{{ old('bonus') }}" class="w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400" placeholder="0">
                                </div>
                            </div>

                            <!-- Potongan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Potongan
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 dark:text-gray-400 font-bold">Rp</span>
                                    <input type="number" name="deduction" value="{{ old('deduction') }}" class="w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400" placeholder="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="px-8 py-5 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-dark-border flex justify-end items-center gap-4">
                    <a href="{{ route('salaries.index') }}" class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-white dark:hover:bg-gray-700 transition font-medium">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-lg hover:shadow-xl transition font-bold flex items-center gap-2 transform active:scale-95">
                        <i class="fa-solid fa-save"></i> Simpan Data Gaji
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript untuk Pencarian Pegawai -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const employees = {!! json_encode($employees) !!};
            const searchInput = document.getElementById('search-input');
            const listContainer = document.getElementById('employee-list-container');
            const selectedUserIdInput = document.getElementById('selected-user-id');
            const selectedNameDisplay = document.getElementById('selected-name');
            const selectedUserDisplay = document.getElementById('selected-user-display');

            function renderList(query = '') {
                listContainer.innerHTML = '';
                const filteredEmployees = employees.filter(emp => {
                    const fullName = emp.name.toLowerCase();
                    const email = emp.email.toLowerCase();
                    const q = query.toLowerCase();
                    return fullName.includes(q) || email.includes(q);
                });

                if (filteredEmployees.length === 0 && query !== '') {
                    listContainer.innerHTML = '<div class="p-4 text-center text-gray-500 dark:text-gray-400 text-sm">Pegawai tidak ditemukan.</div>';
                    return;
                }

                filteredEmployees.forEach(emp => {
                    const hasSalary = emp.salary !== null;

                    const item = document.createElement('div');
                    item.className = 'p-4 cursor-pointer hover:bg-green-50 dark:hover:bg-gray-700 transition border-b border-gray-200 dark:border-gray-700 last:border-b-0';
                    item.setAttribute('data-id', emp.id);
                    item.setAttribute('data-name', emp.name);
                    item.onclick = () => selectEmployee(emp);

                    item.innerHTML = `
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">${emp.name}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    ${emp.position ? emp.position.title : 'Jabatan Belum Diatur'}
                                </p>
                            </div>
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold ${hasSalary ? 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300' : 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300'}">
                                ${hasSalary ? 'SUDAH DIGAJI' : 'BELUM DIGAJI'}
                            </span>
                        </div>
                    `;
                    listContainer.appendChild(item);
                });

                // Tampilkan container jika ada hasil atau jika input kosong (tampilkan semua)
                listContainer.style.display = 'block';
            }

            function selectEmployee(employee) {
                selectedUserIdInput.value = employee.id;
                selectedNameDisplay.textContent = employee.name;
                searchInput.value = employee.name; // Isi input dengan nama yang dipilih

                // Sembunyikan list setelah memilih
                listContainer.style.display = 'none';

                // Beri indikator visual
                selectedUserDisplay.classList.remove('bg-gray-50', 'dark:bg-gray-700');
                selectedUserDisplay.classList.add('bg-green-50', 'dark:bg-green-900/20', 'border-green-200', 'dark:border-green-700');
            }

            searchInput.addEventListener('input', function() {
                renderList(this.value);
            });

            searchInput.addEventListener('focus', function() {
                renderList(this.value);
            });

            document.addEventListener('click', function(e) {
                const isClickInside = searchInput.contains(e.target) || listContainer.contains(e.target);
                if (!isClickInside) {
                    listContainer.style.display = 'none';
                }
            });

            // Handle old value jika ada error validasi dari server
            const oldUserId = selectedUserIdInput.value;
            if (oldUserId) {
                const oldEmployee = employees.find(emp => emp.id == oldUserId);
                if (oldEmployee) {
                    selectEmployee(oldEmployee);
                }
            }
        });
    </script>
@endsection