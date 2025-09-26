<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Pegawai')</title>
    <style>
        /* Reset dasar dan gaya font */
        body, html {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
            color: #212529;
        }

        /* Wrapper utama menggunakan Flexbox */
        .page-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Navigasi */
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar-header h2 {
            margin: 0 0 30px 0;
            text-align: center;
            font-size: 24px;
        }

        .sidebar-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: #ced4da;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar-nav li a:hover, .sidebar-nav li a.active {
            background-color: #495057;
            color: #ffffff;
        }

        .sidebar-footer {
            margin-top: auto;
            text-align: center;
            font-size: 14px;
            color: #adb5bd;
        }

        /* Konten Utama */
        .main-content {
            flex-grow: 1;
            padding: 30px;
            display: flex;
            flex-direction: column;
        }

        .main-header {
            margin-bottom: 25px;
        }

        .main-header h1 {
            margin: 0;
            font-size: 32px;
        }

        .content-body {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            flex-grow: 1;
        }
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
                    <li><a href="{{ route('employees.index') }}" class="active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10Zm-9.995-.944v-.002.002Z M3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004Zm9.974.056v-.002.002Z M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        <span>Employee</span>
                    </a></li>
                    <li><a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3Zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3Zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3Zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3Z"/></svg>
                        <span>Department</span>
                    </a></li>
                    <li><a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5ZM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1Z"/></svg>
                        <span>Attendance</span>
                    </a></li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <p>&copy; {{ date('Y') }}</p>
            </div>
        </aside>

        <div class="main-content">
            <header class="main-header">
                <h1>@yield('page-title', 'Dashboard')</h1>
            </header>
            <main class="content-body">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>