<p align="center">
<h1 align="center">Sistem Informasi Manajemen Kepegawaian (HR System)</h1>
</p>

<p align="center">
<a href="https://laravel.com"><img src="https://www.google.com/search?q=https://img.shields.io/badge/Laravel-12-FF2D20.svg%3Fstyle%3Dfor-the-badge%26logo%3Dlaravel%26logoColor%3Dwhite" alt="Laravel 12"></a>
<a href="https://tailwindcss.com"><img src="https://www.google.com/search?q=https://img.shields.io/badge/Tailwind_CSS-v4-38B2AC.svg%3Fstyle%3Dfor-the-badge%26logo%3Dtailwind-css%26logoColor%3Dwhite" alt="Tailwind CSS"></a>
<a href="https://php.net"><img src="https://www.google.com/search?q=https://img.shields.io/badge/PHP-8.2%2B-777BB4.svg%3Fstyle%3Dfor-the-badge%26logo%3Dphp%26logoColor%3Dwhite" alt="PHP"></a>
<a href="#"><img src="https://www.google.com/search?q=https://img.shields.io/badge/License-MIT-green.svg%3Fstyle%3Dfor-the-badge" alt="License"></a>
</p>

<p align="center">
<strong>Dibuat oleh:</strong> Gusthi Pangestu 




<strong>NRP:</strong> 3124600098 




<strong>Kelas:</strong> D4 IT D
</p>

<hr>

Tentang Aplikasi

Aplikasi ini adalah sistem manajemen Sumber Daya Manusia (SDM) berbasis web modern yang dirancang untuk memudahkan pengelolaan data pegawai, struktur organisasi, penggajian, serta presensi harian secara real-time. Dibangun dengan fondasi Laravel 12 yang kuat dan antarmuka Tailwind CSS yang responsif.

🌟 Fitur Unggulan

1. Portal Pegawai (Self-Service)

Login Praktis: Masuk menggunakan kombinasi Email dan Jabatan (tanpa password rumit) untuk kemudahan akses.

Presensi Cepat: Dashboard khusus untuk melakukan Absen Masuk dan Pulang dengan satu klik.

Pelaporan Izin: Fitur untuk mengajukan status Sakit atau Izin beserta keterangannya.

Riwayat Kehadiran: Pegawai dapat memantau log presensi pribadi mereka sendiri.

2. Panel Administrator (HR)

Keamanan Tinggi: Login khusus admin menggunakan Email & Password terenkripsi.

Dashboard Statistik: Visualisasi data pegawai, kehadiran hari ini, dan statistik departemen.

Manajemen Data Master:

Pegawai: Input data dengan validasi unik (Email tidak boleh kembar). Otomatisasi pemilihan departemen berdasarkan jabatan.

Departemen: Pengelolaan divisi perusahaan dengan validasi nama unik.

Jabatan: Pengaturan jabatan dan gaji dasar yang terikat pada departemen tertentu (Relasi One-to-Many).

Penggajian (Payroll): Perhitungan gaji bulanan dengan komponen gaji pokok, tunjangan, bonus, dan potongan. Dilengkapi validasi untuk mencegah input gaji ganda.

Mode Gelap (Dark Mode): Antarmuka yang mendukung mode gelap untuk kenyamanan mata pengguna.

🔐 Sistem Otentikasi

Aplikasi ini menggunakan dua metode otentikasi yang berbeda untuk menyesuaikan kebutuhan pengguna:

Otentikasi Pegawai (Tanpa Password):

Menggunakan kombinasi Email dan Jabatan.

Alasan: Mempermudah akses harian pegawai untuk presensi cepat tanpa perlu mengingat password yang rumit, cocok untuk lingkungan kerja yang dinamis atau penggunaan perangkat bersama (kiosk). Keamanan tetap terjaga karena email bersifat unik.

Otentikasi Administrator (Email & Password):

Menggunakan standar keamanan login Laravel dengan Email dan Password terenkripsi.

Alasan: Administrator memiliki akses penuh ke data sensitif (gaji, data pribadi pegawai), sehingga memerlukan lapisan keamanan ganda berupa password.

🛠️ Teknologi & Library yang Digunakan

Kami menggunakan teknologi terkini untuk memastikan performa dan kemudahan pengembangan:

Utama (Core)

Laravel 12 - Framework PHP utama yang menangani logika aplikasi, routing, dan keamanan.

PHP 8.2+ - Bahasa pemrograman server-side.

HeidiSQL - Sistem manajemen basis data relasional.

Frontend & UI

Tailwind CSS v4 - Framework CSS utility-first untuk desain UI yang modern dan responsif.

Font Awesome - Pustaka ikon vektor untuk mempercantik tampilan menu dan tombol.

Vite - Build tool modern untuk aset frontend yang sangat cepat.

Blade Templates - Mesin templating bawaan Laravel untuk membuat tampilan yang dinamis.

Library Pendukung (Laravel Ecosystem)

Eloquent ORM: Untuk interaksi database yang elegan dan manajemen relasi antar tabel (One-to-Many, Many-to-One).

Laravel Breeze / UI (Auth Scaffolding): Dasar sistem otentikasi yang dimodifikasi.

Carbon: Library PHP untuk manipulasi tanggal dan waktu yang digunakan pada fitur presensi.

Instalasi & Penggunaan

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal Anda:

Clone Repositori

git clone [https://github.com/username/app-pegawai.git](https://github.com/username/app-pegawai.git)
cd app-pegawai


Install Dependencies

composer install
npm install


Setup Environment
Salin file contoh konfigurasi dan atur koneksi database Anda.

cp .env.example .env
php artisan key:generate


Pastikan Anda telah membuat database di MySQL sesuai dengan konfigurasi di file .env.

Migrasi Database
Jalankan migrasi dan seeder untuk mengisi tabel dan data dummy awal.

php artisan migrate:fresh --seed


Jalankan Aplikasi
Buka dua terminal terpisah untuk menjalankan server PHP dan proses build frontend.

Terminal 1:

php artisan serve


Terminal 2:

npm run dev


Akses aplikasi di: http://127.0.0.1:8000

Akun Demo

Gunakan kredensial berikut untuk mencoba fitur aplikasi setelah menjalankan seeder:

Role

URL Login

Email / Username

Password / Jabatan

Administrator

/admin/login

admin@hr.com

password

Pegawai

/login

budi@pegawai.com

(Pilih Jabatan Sesuai)

Lisensi

Aplikasi ini adalah perangkat lunak open-source di bawah lisensi MIT license.