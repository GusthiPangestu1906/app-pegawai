<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - HR System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg hidden md:block">
            <div class="p-6 border-b">
                <div class="flex items-center gap-2 text-blue-600">
                    <i class="fa-solid fa-building-user text-2xl"></i>
                    <h1 class="text-xl font-bold">HR System</h1>
                </div>
            </div>
            <nav class="mt-6 px-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <i class="fa-solid fa-chart-pie w-6"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
            <nav class="mt-6 px-4">
                
                <!-- Link Kembali ke Mode Pegawai -->
                <a href="{{ route('employee.dashboard') }}" class="flex items-center px-4 py-3 mb-4 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 rounded-lg border border-indigo-200 transition">
                    <i class="fa-solid fa-arrow-left w-6"></i>
                    <span class="font-bold">Mode Presensi</span>
                </a>

                <a href="{{ route('admin.dashboard') }}" class="...">
                
                <div class="mt-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Master Data</p>
                    
                    <a href="{{ route('employees.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition {{ request()->routeIs('employees.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <i class="fa-solid fa-users w-6"></i>
                        <span class="font-medium">Pegawai</span>
                    </a>

                    <a href="{{ route('departments.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition {{ request()->routeIs('departments.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <i class="fa-solid fa-building w-6"></i>
                        <span class="font-medium">Departemen</span>
                    </a>

                    <a href="{{ route('positions.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition {{ request()->routeIs('positions.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <i class="fa-solid fa-briefcase w-6"></i>
                        <span class="font-medium">Jabatan</span>
                    </a>

                    <a href="{{ route('salaries.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition {{ request()->routeIs('salaries.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <i class="fa-solid fa-money-bill-wave w-6"></i>
                        <span class="font-medium">Penggajian</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6">
                <button class="md:hidden text-gray-600">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div class="flex items-center gap-4 ml-auto">
                    <span class="text-sm text-gray-500">Administrator</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 flex-1 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>