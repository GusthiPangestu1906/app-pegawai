<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Pegawai')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar Pegawai -->
        <aside class="w-64 bg-white shadow-lg hidden md:block fixed h-full">
            <div class="p-6 border-b">
                <div class="flex items-center gap-2 text-indigo-600">
                    <i class="fa-solid fa-user-clock text-2xl"></i>
                    <h1 class="text-xl font-bold">Presensi App</h1>
                </div>
            </div>
            <nav class="mt-6 px-4 space-y-2">
                
                <!-- Menu Umum -->
                <a href="{{ route('employee.dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition {{ request()->routeIs('employee.dashboard') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                    <i class="fa-solid fa-house w-6"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <a href="{{ route('history') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition {{ request()->routeIs('history') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                    <i class="fa-solid fa-clock-rotate-left w-6"></i>
                    <span class="font-medium">Riwayat Presensi</span>
                </a>

                <!-- MENU KHUSUS ADMIN (Hanya muncul jika role admin) -->
                @if(Auth::user() && Auth::user()->role === 'admin')
                    <div class="pt-4 mt-4 border-t border-gray-100">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Akses HR</p>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition">
                            <i class="fa-solid fa-user-shield w-6"></i>
                            <span class="font-medium">Panel Admin</span>
                        </a>
                    </div>
                @endif

            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:ml-64">
            <!-- Header Mobile -->
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 sticky top-0 z-10">
                <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600 hidden md:inline">Halo, <strong>{{ Auth::user()->name }}</strong></span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-red-600 transition" title="Logout">
                            <i class="fa-solid fa-right-from-bracket text-lg"></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Content -->
            <main class="p-6 flex-1 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>