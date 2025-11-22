<!DOCTYPE html>
<html lang="en" class="light"> <!-- Default light -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - HR System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    
    <!-- Konfigurasi Tailwind untuk Dark Mode -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: {
                            bg: '#111827',      // Gray 900
                            card: '#1F2937',    // Gray 800
                            text: '#F3F4F6',    // Gray 100
                            muted: '#9CA3AF',   // Gray 400
                            border: '#374151'   // Gray 700
                        }
                    }
                }
            }
        }
    </script>

    <!-- Script untuk Cek Preferensi User Sebelum Halaman Loading -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-dark-bg font-sans transition-colors duration-200">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-dark-card shadow-lg hidden md:block fixed h-full border-r dark:border-dark-border transition-colors duration-200">
            <div class="p-6 border-b dark:border-dark-border">
                <div class="flex items-center gap-2 text-blue-600 dark:text-blue-400">
                    <i class="fa-solid fa-building-user text-2xl"></i>
                    <h1 class="text-xl font-bold">HR System</h1>
                </div>
            </div>
            <nav class="mt-6 px-4">
                 <!-- Link Kembali ke Mode Pegawai -->
                <a href="{{ route('employee.dashboard') }}" class="flex items-center px-4 py-3 mb-4 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 rounded-lg border border-indigo-200 transition">
                    <i class="fa-solid fa-arrow-left w-6"></i>
                    <span class="font-bold">Presensi Admin</span>
                </a>

                <a href="{{ route('admin.dashboard') }}" class="...">

                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 dark:bg-gray-700 text-blue-600 dark:text-blue-400' : '' }}">
                    <i class="fa-solid fa-chart-pie w-6"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <div class="mt-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Master Data</p>
                    
                    <a href="{{ route('employees.index') }}" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition {{ request()->routeIs('employees.*') ? 'bg-blue-50 dark:bg-gray-700 text-blue-600 dark:text-blue-400' : '' }}">
                        <i class="fa-solid fa-users w-6"></i>
                        <span class="font-medium">Pegawai</span>
                    </a>

                    <a href="{{ route('departments.index') }}" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition {{ request()->routeIs('departments.*') ? 'bg-blue-50 dark:bg-gray-700 text-blue-600 dark:text-blue-400' : '' }}">
                        <i class="fa-solid fa-building w-6"></i>
                        <span class="font-medium">Departemen</span>
                    </a>

                    <a href="{{ route('positions.index') }}" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition {{ request()->routeIs('positions.*') ? 'bg-blue-50 dark:bg-gray-700 text-blue-600 dark:text-blue-400' : '' }}">
                        <i class="fa-solid fa-briefcase w-6"></i>
                        <span class="font-medium">Jabatan</span>
                    </a>

                    <a href="{{ route('salaries.index') }}" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition {{ request()->routeIs('salaries.*') ? 'bg-blue-50 dark:bg-gray-700 text-blue-600 dark:text-blue-400' : '' }}">
                        <i class="fa-solid fa-money-bill-wave w-6"></i>
                        <span class="font-medium">Penggajian</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col md:ml-64 min-h-screen">
            <!-- Header -->
            <header class="bg-white dark:bg-dark-card shadow-sm h-16 flex items-center justify-between px-6 sticky top-0 z-10 border-b dark:border-dark-border transition-colors duration-200">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">@yield('title')</h2>
                <div class="flex items-center gap-4 ml-auto">
                    
                    <!-- Dark Mode Toggle Button -->
                    <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 transition">
                        <i id="theme-toggle-dark-icon" class="fa-solid fa-moon hidden"></i>
                        <i id="theme-toggle-light-icon" class="fa-solid fa-sun hidden"></i>
                    </button>

                    <div class="h-6 w-px bg-gray-200 dark:bg-gray-700 mx-2"></div>

                    <span class="text-sm text-gray-500 dark:text-gray-400">Administrator</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 transition" title="Logout">
                            <i class="fa-solid fa-right-from-bracket text-lg"></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 flex-1 overflow-y-auto dark:text-dark-text">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- JavaScript Logic untuk Toggle Dark Mode -->
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Cek kondisi awal dan tampilkan icon yang sesuai
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            // Toggle icon
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // Jika sudah ada setting di local storage
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                // Jika belum ada setting, cek preferensi sistem
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>

</body>
</html>