<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Pegawai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-600 p-6 text-center">
            <i class="fa-solid fa-clock text-4xl text-white mb-2"></i>
            <h2 class="text-2xl font-bold text-white">Portal Presensi</h2>
            <p class="text-blue-100 text-sm">Silakan input identitas Anda</p>
        </div>

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 m-4 text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 m-4 text-sm">
                {{ session('error') }}
            </div>
        @endif
        @if(session('info'))
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 m-4 text-sm">
                {{ session('info') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('presensi.submit') }}" method="POST" class="p-6 pt-2">
            @csrf
            
            <!-- Input Nama -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" type="text" name="name" placeholder="Ketik nama lengkap Anda..." required>
                </div>
            </div>

            <!-- Input Jabatan -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Jabatan</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fa-solid fa-briefcase"></i>
                    </span>
                    <select name="position_id" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white transition" required>
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->title }} - {{ $position->department->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Input Status Kehadiran (Hadir/Sakit/Izin) -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Status Kehadiran</label>
                <div class="grid grid-cols-3 gap-2">
                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="present" class="peer sr-only" checked onchange="toggleNote(false)">
                        <div class="peer-checked:bg-green-600 peer-checked:text-white bg-gray-100 text-gray-600 py-2 rounded-lg text-center text-sm font-medium transition hover:bg-gray-200">
                            Hadir
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="sick" class="peer sr-only" onchange="toggleNote(true)">
                        <div class="peer-checked:bg-yellow-500 peer-checked:text-white bg-gray-100 text-gray-600 py-2 rounded-lg text-center text-sm font-medium transition hover:bg-gray-200">
                            Sakit
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="permission" class="peer sr-only" onchange="toggleNote(true)">
                        <div class="peer-checked:bg-blue-500 peer-checked:text-white bg-gray-100 text-gray-600 py-2 rounded-lg text-center text-sm font-medium transition hover:bg-gray-200">
                            Izin
                        </div>
                    </label>
                </div>
            </div>

            <!-- Input Keterangan (Hanya muncul jika Sakit/Izin) -->
            <div id="note-container" class="mb-6 hidden">
                <label class="block text-gray-700 text-sm font-bold mb-2">Keterangan (Wajib jika Sakit/Izin)</label>
                <textarea name="note" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Tulis alasan sakit atau izin..."></textarea>
            </div>

            <div class="bg-gray-50 px-6 py-4 text-center">
                <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">
                    Masuk sebagai Pegawai / Admin (Login)
                </a>
            </div>

            <button type="submit" class="w-full bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-md flex justify-center items-center gap-2">
                <i class="fa-solid fa-paper-plane"></i> Kirim Laporan
            </button>
        </form>

        <script>
            function toggleNote(show) {
                const noteContainer = document.getElementById('note-container');
                const noteInput = noteContainer.querySelector('textarea');
                if (show) {
                    noteContainer.classList.remove('hidden');
                    noteInput.setAttribute('required', 'required');
                } else {
                    noteContainer.classList.add('hidden');
                    noteInput.removeAttribute('required');
                    noteInput.value = ''; // Clear value
                }
            }
        </script>

</body>
</html>