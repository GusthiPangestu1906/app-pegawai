<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Pegawai')</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background-color: #f4f7f6;
        }
        header {
            background-color: #ffffff;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            margin: 0;
            font-size: 22px;
        }
        nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
        }
        nav li {
            margin-left: 20px;
        }
        nav a {
            text-decoration: none;
            color: #555;
            font-weight: bold;
        }
        main {
            padding: 30px;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <header>
        <h1>@yield('page-title', 'App Pegawai')</h1>
        <nav>
            <ul>
                <li><a href="{{ route('employees.index') }}">Employee</a></li>
                <li><a href="#">Department</a></li>
                <li><a href="#">Attendance</a></li>
                <li><a href="#">Report</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Aplikasi Pegawai</p>
    </footer>

</body>
</html>