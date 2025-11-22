<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HR System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-600 p-8 text-center">
            <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fa-solid fa-users text-3xl text-blue-600"></i>
            </div>
            <h2 class="text-2xl font-bold text-white">Portal Pegawai</h2>
            <p class="text-blue-100 text-sm">Masuk menggunakan identitas Anda</p>
        </div>

        <!-- Form -->
        <div class="p-8">
            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-6 text-sm rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <!-- Input Nama -->
                <div class="mb-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input type="text" name="name" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" placeholder="Sesuai data HR..." required autofocus>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">*Pastikan nama sesuai dengan data pendaftaran.</p>
                </div>

                <!-- Input Jabatan -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Jabatan</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fa-solid fa-briefcase"></i>
                        </span>
                        <select name="position_id" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white transition" required>
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach($positions as $position)
                                <option value="{{ $position->id }}">
                                    {{ $position->title }} 
                                    @if($position->department)
                                        - {{ $position->department->name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-md flex justify-center items-center gap-2">
                    Masuk Sistem <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </button>
            </form>
        </div>
        
        <div class="bg-gray-50 p-4 text-center text-xs text-gray-500">
            &copy; 2025 HR Management System
        </div>
    </div>

</body>
</html>