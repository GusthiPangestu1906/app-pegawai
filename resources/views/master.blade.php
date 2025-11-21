<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Pegawai')</title>
    <style>
        /* Reset & Konfigurasi Dasar */
        :root {
            --sidebar-width: 260px;
            --header-height: 70px;
            
            /* Skema Warna Sidebar (Gelap) */
            --sidebar-bg: #2c3e50; 
            --sidebar-text: #adb5bd;
            --sidebar-text-hover: #ffffff;
            --sidebar-bg-hover: #34495e;
            --sidebar-bg-active: #0d6efd; 
            
            /* Skema Warna Konten (Terang) */
            --header-bg: #ffffff;
            --content-bg: #ffffff;
            --page-bg: #f8f9fa;

            --text-primary: #212529;
            --text-secondary: #6c757d;
            --border-color: #dee2e6;
        }
        body, html {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--page-bg);
            color: var(--text-primary);
        }

        /* Sidebar Navigasi (Versi Gelap) */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--sidebar-bg);
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }
        .sidebar-header {
            text-align: center;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--sidebar-bg-hover);
        }
        .sidebar-header h2 { 
            margin: 0; 
            font-size: 24px; 
            color: var(--sidebar-text-hover);
        }
        .sidebar-nav ul { list-style: none; padding: 0; margin: 0; }
        .sidebar-nav li a {
            display: flex;
            justify-content: space-between; /* Untuk panah dropdown */
            align-items: center;
            gap: 15px;
            padding: 12px 15px;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
            font-weight: 500;
            transition: background-color 0.2s ease, color 0.2s ease;
            white-space: nowrap; 
        }
        .sidebar-nav li a:hover { 
            background-color: var(--sidebar-bg-hover);
            color: var(--sidebar-text-hover);
        }
        /* Logika 'active' dipindahkan ke 'li' untuk menangani parent */
        .sidebar-nav li.active > a {
            background-color: var(--sidebar-bg-active);
            color: var(--sidebar-text-hover);
        }
        .sidebar-nav li a svg { 
            width: 20px; 
            height: 20px;
            fill: currentColor; 
            flex-shrink: 0; 
        }
        .sidebar-footer {
            margin-top: auto;
            text-align: center;
            font-size: 14px;
            color: var(--sidebar-text);
        }
        
        /* === BARU: Gaya untuk Sub-menu === */
        .sidebar-nav li .icon-wrapper {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .submenu-toggle {
            transition: transform 0.3s ease;
        }
        li.open > a .submenu-toggle {
            transform: rotate(90deg);
        }
        .sidebar-submenu {
            list-style: none;
            padding: 0 0 0 25px; /* Indentasi submenu */
            margin: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .sidebar-submenu.active {
            max-height: 500px; /* Atur ke tinggi maksimum yang cukup */
            transition: max-height 0.5s ease-in;
        }
        .sidebar-submenu li a {
            padding: 10px 15px 10px 28px; /* Lebih indentasi */
            font-size: 0.9em;
        }
        .sidebar-submenu li a.active {
             background-color: transparent; /* Hanya parent yang biru */
             color: var(--sidebar-text-hover); /* Teks sub-menu aktif putih */
        }
        /* ================================ */

        /* Kontainer untuk area kanan (header + konten) */
        .content-container {
            margin-left: var(--sidebar-width);
        }

        /* Header Utama (di atas konten) */
        .main-header {
            height: var(--header-height);
            width: calc(100% - var(--sidebar-width));
            background-color: var(--header-bg);
            border-bottom: 1px solid var(--border-color);
            position: fixed;
            top: 0;
            right: 0;
            display: flex;
            align-items: center;
            justify-content: space-between; 
            padding: 0 30px;
            box-sizing: border-box;
            z-index: 10;
        }
        .main-header h1 { margin: 0; font-size: 28px; font-weight: 600; }
        
        /* === DIUBAH: Gaya Header Kanan (Hanya Profil) === */
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }
        .user-profile img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
        }
        .user-profile span {
            font-weight: 500;
        }
        /* ========================================================== */
        
        /* Konten Utama */
        .main-content {
            padding-top: var(--header-height); 
            padding: 30px;
            padding-top: calc(var(--header-height) + 30px);
        }
        .content-body {
            background-color: var(--content-bg);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        /* Gaya Umum (Sudah ada) */
        .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .table-header h2 { margin: 0; font-size: 20px; font-weight: 600; }
        .btn-add {
            display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px;
            background-color: var(--sidebar-bg-active); color: white; text-decoration: none;
            border-radius: 6px; font-weight: 500; transition: background-color 0.2s;
        }
        .btn-add:hover { background-color: #0b5ed7; }
        .styled-table { width: 100%; border-collapse: collapse; font-size: 15px; }
        .styled-table thead tr { background-color: #f8f9fa; color: #495057; }
        .styled-table th { padding: 12px 15px; font-weight: 600; text-align: left; }
        .styled-table td { padding: 12px 15px; border-bottom: 1px solid #e9ecef; }
        .styled-table tbody tr:hover { background-color: #f1f3f5; }
        .action-links { display: flex; align-items: center; gap: 15px; }
        .action-links a, .action-links button { color: var(--text-secondary); transition: color 0.2s; }
        .action-links a:hover, .action-links button:hover { color: var(--text-primary); }
        .action-links form { display: inline; }
        .action-links button { background: none; border: none; cursor: pointer; padding: 0; }
    </style>
</head>
<body>

    <div class="page-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>App Pegawai</h2>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    {{-- Cek apakah halaman Dashboard, Employee, Dept, atau Position sedang aktif --}}
                    @php
                        $isManajemenDataOpen = Request::is('employees*') || Request::is('departments*') || Request::is('positions*') || Request::is('/');
                    @endphp
                    <li class="{{ $isManajemenDataOpen ? 'open active' : '' }}">
                        <a href="javascript:void(0)" data-toggle="submenu">
                            <div class="icon-wrapper">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                                <span>Manajemen Data</span>
                            </div>
                            <svg class="submenu-toggle" viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M9.29 15.88L13.17 12 9.29 8.12a.996.996 0 1 1 1.41-1.41l4.59 4.59c.39.39.39 1.02 0 1.41L10.7 17.3a.996.996 0 0 1-1.41 0c-.38-.39-.39-1.03 0-1.42z"/></svg>
                        </a>
                        {{-- Sub-menu untuk Manajemen Data --}}
                        <ul class="sidebar-submenu {{ $isManajemenDataOpen ? 'active' : '' }}">
                            <li><a href="{{ route('employees.index') }}" class="{{ Request::is('employees*') || Request::is('/') ? 'active' : '' }}">
                                <span>Employee</span>
                            </a></li>
                            <li><a href="{{ route('departments.index') }}" class="{{ Request::is('departments*') ? 'active' : '' }}">
                                <span>Department</span>
                            </a></li>
                            <li><a href="{{ route('positions.index') }}" class="{{ Request::is('positions*') ? 'active' : '' }}">
                                <span>Position</span>
                            </a></li>
                        </ul>
                    </li>

                    @php
                        $isOperasionalOpen = Request::is('attendances*') || Request::is('salaries*');
                    @endphp
                    <li class="{{ $isOperasionalOpen ? 'open active' : '' }}">
                        <a href="javascript:void(0)" data-toggle="submenu">
                             <div class="icon-wrapper">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                <span>Operasional</span>
                            </div>
                            <svg class="submenu-toggle" viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M9.29 15.88L13.17 12 9.29 8.12a.996.996 0 1 1 1.41-1.41l4.59 4.59c.39.39.39 1.02 0 1.41L10.7 17.3a.996.996 0 0 1-1.41 0c-.38-.39-.39-1.03 0-1.42z"/></svg>
                        </a>
                        {{-- Sub-menu untuk Operasional --}}
                        <ul class="sidebar-submenu {{ $isOperasionalOpen ? 'active' : '' }}">
                            <li><a href="{{ route('attendances.index') }}" class="{{ Request::is('attendances*') ? 'active' : '' }}">
                                <span>Attendance</span>
                            </a></li>
                            <li><a href="{{ route('salaries.index') }}" class="{{ Request::is('salaries*') ? 'active' : '' }}">
                                <span>Salaries</span>
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <p>&copy; {{ date('Y') }} Aplikasi Pegawai</p>
            </div>
        </aside>

        <div class="content-container">
             <header class="main-header">
                {{-- Judul Halaman Tetap di Kiri --}}
                <h1>@yield('page-title', 'Dashboard')</h1>

                {{-- DIUBAH: Wrapper header kanan sekarang hanya berisi profil --}}
                <div class="header-right">
                    <div class="user-profile">
                        <img src="https://placehold.co/40x40/EFEFEF/AAAAAA?text=U" alt="User Avatar">
                        <span>User</span>
                    </div>
                </div>
             </header>
            <main class="main-content">
                <div class="content-body">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    {{-- BARU: JavaScript untuk toggle sub-menu --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil semua tombol toggle
            const toggles = document.querySelectorAll('[data-toggle="submenu"]');

            toggles.forEach(toggle => {
                toggle.addEventListener('click', function (e) {
                    e.preventDefault(); // Mencegah link `a` berpindah halaman
                    
                    // Ambil parent `li`
                    const parentLi = this.parentElement;

                    // Ambil sub-menu (elemen berikutnya)
                    const submenu = this.nextElementSibling;

                    // Toggle class 'open' pada parent `li`
                    parentLi.classList.toggle('open');
                    
                    // Toggle class 'active' pada sub-menu
                    submenu.classList.toggle('active');
                });
            });
        });
    </script>

</body>
</html>

