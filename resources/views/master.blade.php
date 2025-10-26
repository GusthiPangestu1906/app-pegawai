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
        }
        body, html {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
            color: #212529;
        }

        /* Sidebar Navigasi */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #ffffff;
            border-right: 1px solid #dee2e6;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }
        .sidebar-header {
            text-align: center;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #dee2e6;
        }
        .sidebar-header h2 { margin: 0; font-size: 24px; color: #343a40; }
        .sidebar-nav ul { list-style: none; padding: 0; margin: 0; }
        .sidebar-nav li a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 15px;
            color: #495057;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
            font-weight: 500;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .sidebar-nav li a:hover { background-color: #e9ecef; }
        .sidebar-nav li a.active {
            background-color: #0d6efd;
            color: #ffffff;
        }
        .sidebar-nav li a svg { width: 20px; height: 20px; }
        .sidebar-footer {
            margin-top: auto;
            text-align: center;
            font-size: 14px;
            color: #6c757d;
        }

        /* Kontainer untuk area kanan (header + konten) */
        .content-container {
            margin-left: var(--sidebar-width);
        }

        /* Header Utama (di atas konten) */
        .main-header {
            height: var(--header-height);
            width: calc(100% - var(--sidebar-width));
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            position: fixed;
            top: 0;
            right: 0;
            display: flex;
            align-items: center;
            padding: 0 30px;
            box-sizing: border-box;
            z-index: 10;
        }
        .main-header h1 { margin: 0; font-size: 28px; font-weight: 600; }
        
        /* Konten Utama */
        .main-content {
            padding-top: var(--header-height); /* Memberi ruang untuk header yang fixed */
            padding: 30px;
            padding-top: calc(var(--header-height) + 30px);
        }
        .content-body {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        /* Gaya Umum untuk Tabel & Tombol */
        .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .table-header h2 { margin: 0; font-size: 20px; font-weight: 600; }
        .btn-add {
            display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px;
            background-color: #0d6efd; color: white; text-decoration: none;
            border-radius: 6px; font-weight: 500; transition: background-color 0.2s;
        }
        .btn-add:hover { background-color: #0b5ed7; }
        .styled-table { width: 100%; border-collapse: collapse; font-size: 15px; }
        .styled-table thead tr { background-color: #f8f9fa; color: #495057; }
        .styled-table th { padding: 12px 15px; font-weight: 600; text-align: left; }
        .styled-table td { padding: 12px 15px; border-bottom: 1px solid #e9ecef; }
        .styled-table tbody tr:hover { background-color: #f1f3f5; }
        .action-links { display: flex; align-items: center; gap: 15px; }
        .action-links a, .action-links button { color: #6c757d; transition: color 0.2s; }
        .action-links a:hover, .action-links button:hover { color: #212529; }
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
                    <li><a href="{{ route('employees.index') }}" class="{{ Request::is('employees*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                        <span>Employee</span>
                    </a></li>
                    <li><a href="{{ route('departments.index') }}" class="{{ Request::is('departments*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/></svg>
                        <span>Department</span>
                    </a></li>
                    <li><a href="{{ route('attendances.index') }}" class="{{ Request::is('attendances*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/></svg>
                        <span>Attendance</span>
                    </a></li>
                    <li><a href="{{ route('positions.index') }}" class="{{ Request::is('positions*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
                        <span>Position</span>
                    </a></li>
                    <li><a href="{{ route('salaries.index') }}" class="{{ Request::is('salaries*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM13 20.01L4 11V4h7v-.01l9 9-7 7.01z"/><circle cx="6.5" cy="6.5" r="1.5"/></svg>
                        <span>Salaries</span>
                    </a></li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <p>&copy; {{ date('Y') }} Aplikasi Pegawai</p>
            </div>
        </aside>

        <div class="content-container">
             <header class="main-header">
                <h1>@yield('page-title', 'Dashboard')</h1>
            </header>
            <main class="main-content">
                <div class="content-body">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

</body>
</html>

