<<<<<<< HEAD
📘 Sistem Informasi Manajemen Kepegawaian (HR System)
<p align="center"> <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="350" alt="Laravel Logo"> </p> <p align="center"> <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"></a> <a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white"></a> <a href="https://php.net"><img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"></a> <img src="https://img.shields.io/badge/License-MIT-45b848?style=for-the-badge"> </p> <p align="center"> <strong>Dibuat oleh:</strong> Gusthi Pangestu • <strong>NRP:</strong> 3124600098 • <strong>Kelas:</strong> D4 IT D </p>

📖 Tentang Aplikasi
=======
<p align="center">
<h1 align="center">Sistem Informasi Manajemen Kepegawaian (HR System)</h1>
</p>

<p align="center"> <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="350" alt="Laravel Logo"> </p> <p align="center"> <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"></a> <a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white"></a> <a href="https://php.net"><img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"></a> <img src="https://img.shields.io/badge/License-MIT-45b848?style=for-the-badge"> </p> <p align="center"> <strong>Dibuat oleh:</strong> Gusthi Pangestu | <strong>NRP:</strong> 3124600098 | <strong>Kelas:</strong> D4 IT D </p>

<h2>📖 Tentang Aplikasi</h2>
>>>>>>> 966cbc393aa7b356400779aacc5acd418eb5d474

HR System adalah aplikasi manajemen Sumber Daya Manusia (SDM) berbasis web modern yang dirancang untuk menyederhanakan proses administrasi perusahaan. Aplikasi ini menangani pengelolaan data pegawai, struktur organisasi (departemen & jabatan), penggajian otomatis, serta sistem presensi harian yang real-time.

Dibangun di atas fondasi Laravel 12 yang kuat dan antarmuka Tailwind CSS yang responsif, aplikasi ini menawarkan pengalaman pengguna yang cepat, aman, dan nyaman.

<h2>🌟 Fitur Unggulan</h2>

1. Portal Pegawai (Self-Service)

Portal khusus untuk karyawan yang memudahkan aktivitas harian:

Login Praktis: Masuk menggunakan kombinasi Email dan Jabatan (tanpa password rumit).

Presensi Cepat: Dashboard khusus untuk melakukan Absen Masuk dan Pulang dengan satu klik.

Pelaporan Izin: Fitur untuk mengajukan status Sakit atau Izin beserta keterangannya.

Riwayat Kehadiran: Pegawai dapat memantau log presensi pribadi mereka sendiri secara lengkap.

2. Panel Administrator (HR)

Dashboard manajemen pusat dengan kontrol penuh:

Keamanan Tinggi: Login khusus admin menggunakan Email & Password terenkripsi.

Dashboard Statistik: Visualisasi data pegawai, kehadiran hari ini, dan statistik departemen secara real-time.

Manajemen Data Master:

Pegawai: Input data dengan validasi unik (Email tidak boleh kembar) dan otomatisasi pemilihan departemen.

Departemen: Pengelolaan divisi perusahaan dengan validasi nama unik.

Jabatan: Pengaturan jabatan dan gaji dasar yang terikat pada departemen tertentu (Relasi One-to-Many).

Penggajian (Payroll): Perhitungan gaji bulanan dengan komponen gaji pokok, tunjangan, bonus, dan potongan. Dilengkapi validasi untuk mencegah input gaji ganda.

Mode Gelap (Dark Mode): Antarmuka yang mendukung mode gelap untuk kenyamanan mata pengguna.

<h2>🔐 Mengapa Ada Dua Sistem Otentikasi?</h2>

Aplikasi ini menerapkan pendekatan Dual-Authentication untuk menyeimbangkan keamanan dan kemudahan penggunaan:

1. Otentikasi Pegawai (Tanpa Password)

Metode: Login menggunakan Email & Jabatan.

Alasan: Dirancang untuk kecepatan dan kemudahan akses harian, terutama di lingkungan kerja yang sibuk atau penggunaan perangkat bersama (kiosk mode). Keamanan tetap terjaga karena email bersifat unik dan validasi jabatan.

2. Otentikasi Administrator (Email & Password)

Metode: Login standar Laravel dengan password terenkripsi.

Alasan: Administrator memiliki akses ke data sensitif (seperti gaji dan data pribadi seluruh pegawai), sehingga memerlukan lapisan keamanan ganda yang ketat.

<h2>🛠️ Teknologi & Library</h2>

Kami menggunakan teknologi terkini untuk memastikan performa, keamanan, dan kemudahan pengembangan:

Backend (Server-Side)

Laravel 12: Framework PHP utama.

PHP 8.2+: Bahasa pemrograman.

HeidiSQL: Database relasional.

Frontend (Client-Side)

Tailwind CSS v4: Framework CSS utility-first untuk desain modern.

Vite: Build tool aset frontend yang sangat cepat.

Font Awesome: Pustaka ikon vektor untuk UI (Sidebar, Tombol).

<h2>Library Pendukung</h2>

Eloquent ORM: Manajemen database dan relasi antar tabel.

Blade Templates: Mesin templating untuk tampilan dinamis.

Carbon: Manipulasi tanggal dan waktu (untuk fitur presensi).

Laravel Breeze / UI: Dasar sistem otentikasi.
<h2></h2>
