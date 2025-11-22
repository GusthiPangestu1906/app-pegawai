<p align="center">
<a href="https://laravel.com" target="_blank">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</a>
</p>

<p align="center">
<h1 align="center">Sistem Informasi Manajemen Kepegawaian (HR System)</h1>
</p>

<p align="center">
<!-- Perhatikan: Link di bawah ini langsung ke shields.io, TIDAK ADA https://www.google.com/search?q=google.com -->
<a href="https://laravel.com">
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/380px-Laravel.svg.png" alt="Laravel 12">
</a>
<a href="https://tailwindcss.com">
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/06/Tailwind_CSS_logo_with_dark_text.svg/1024px-Tailwind_CSS_logo_with_dark_text.svg.png" alt="Tailwind CSS">
</a>
<a href="https://php.net">
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1422px-PHP-logo.svg.png" alt="PHP">
</a>
</p>

<p align="center">
<strong>Dibuat oleh:</strong> Gusthi Pangestu &nbsp;•&nbsp;
<strong>NRP:</strong> 3124600098 &nbsp;•&nbsp;
<strong>Kelas:</strong> D4 IT D
</p>

📖 Tentang Aplikasi

HR System adalah aplikasi manajemen Sumber Daya Manusia (SDM) berbasis web modern yang dirancang untuk menyederhanakan proses administrasi perusahaan. Aplikasi ini menangani pengelolaan data pegawai, struktur organisasi (departemen & jabatan), penggajian otomatis, serta sistem presensi harian yang real-time.

Dibangun di atas fondasi Laravel 12 yang kuat dan antarmuka Tailwind CSS yang responsif, aplikasi ini menawarkan pengalaman pengguna yang cepat, aman, dan nyaman.

🌟 Fitur Unggulan

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

🔐 Mengapa Ada Dua Sistem Otentikasi?

Aplikasi ini menerapkan pendekatan Dual-Authentication untuk menyeimbangkan keamanan dan kemudahan penggunaan:

Otentikasi Pegawai (Tanpa Password)

Metode: Login menggunakan Email & Jabatan.

Alasan: Dirancang untuk kecepatan dan kemudahan akses harian, terutama di lingkungan kerja yang sibuk atau penggunaan perangkat bersama (kiosk mode). Keamanan tetap terjaga karena email bersifat unik.

Otentikasi Administrator (Email & Password)

Metode: Login standar Laravel dengan password terenkripsi.

Alasan: Administrator memiliki akses ke data sensitif (seperti gaji dan data pribadi seluruh pegawai), sehingga memerlukan lapisan keamanan ganda yang ketat.

🛠️ Teknologi & Library

Kami menggunakan teknologi terkini untuk memastikan performa, keamanan, dan kemudahan pengembangan:

Backend (Server-Side)

Laravel 12: Framework PHP utama.

PHP 8.2+: Bahasa pemrograman.

MySQL/MariaDB: Database relasional.

Frontend (Client-Side)

Tailwind CSS v4: Framework CSS utility-first untuk desain modern.

Vite: Build tool aset frontend yang sangat cepat.

Font Awesome: Pustaka ikon vektor untuk UI.

Library Pendukung

Eloquent ORM: Manajemen database dan relasi antar tabel.

Blade Templates: Mesin templating untuk tampilan dinamis.

Carbon: Manipulasi tanggal dan waktu (untuk fitur presensi).

Laravel Breeze / UI: Dasar sistem otentikasi.

🚀 Instalasi & Penggunaan

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal Anda:

Clone Repositori

git clone [https://github.com/gusthipangestu1906/app-pegawai.git](https://github.com/gusthipangestu1906/app-pegawai.git)
cd app-pegawai


Install Dependencies

composer install
npm install


Setup Environment
Salin file konfigurasi dan atur koneksi database.

cp .env.example .env
php artisan key:generate


(Pastikan Anda sudah membuat database kosong di MySQL)

Migrasi Database
Jalankan migrasi dan seeder untuk mengisi data awal.

php artisan migrate:fresh --seed


Jalankan Aplikasi
Buka dua terminal terpisah:

# Terminal 1
php artisan serve

# Terminal 2
npm run dev


Akses aplikasi di: http://127.0.0.1:8000

🔑 Akun Demo

Gunakan kredensial berikut untuk mencoba fitur aplikasi setelah menjalankan seeder:

Role

URL Login

Email

Password

Keterangan

Administrator

/admin/login

admin@hr.com

password

Akses penuh ke dashboard

Pegawai

/login

budi@pegawai.com

(Tanpa)

Pilih jabatan sesuai data

📄 Lisensi

Aplikasi ini adalah perangkat lunak open-source di bawah lisensi MIT license.
