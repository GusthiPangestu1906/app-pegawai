<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai Baru</title>
    <style>
        /* Gaya dasar untuk halaman */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        /* Kontainer utama untuk form */
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* Judul form */
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        /* Grup form (label + input) */
        .form-group {
            margin-bottom: 20px;
        }

        /* Label untuk input */
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        /* Styling untuk semua input, textarea, dan select */
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box; /* Penting agar padding tidak mengubah lebar */
            font-size: 16px;
        }

        /* Memberi highlight saat input di-klik */
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Tombol Simpan */
        button {
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Efek hover pada tombol */
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Form Pegawai</h1>

        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input type="text" id="nomor_telepon" name="nomor_telepon" required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="departemen_id">Departemen</label>
                <select id="departemen_id" name="departemen_id" required>
                    <option value="">-- Pilih Departemen --</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->nama_departemen }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="jabatan_id">Jabatan</label>
                <select id="jabatan_id" name="jabatan_id" required>
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->nama_jabatan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk</label>
                <input type="date" id="tanggal_masuk" name="tanggal_masuk" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                    <option value="Cuti">Cuti</option>
                </select>
            </div>

            <button type="submit">Simpan</button>
        </form>
    </div>

</body>
</html>