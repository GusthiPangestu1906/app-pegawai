<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pegawai</title>
    <style>
        /* Gaya dasar halaman */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        /* Kontainer utama */
        .container {
            max-width: 700px;
            margin: 20px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* Judul Halaman */
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        /* Gaya Tabel Detail */
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .detail-table th,
        .detail-table td {
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            text-align: left;
        }

        .detail-table th {
            background-color: #f8f8f8;
            font-weight: 600;
            color: #555;
            width: 35%; /* Mengatur lebar kolom label */
        }

        .detail-table tr:nth-child(even) { /* Warna latar untuk baris genap */
            background-color: #fdfdfd;
        }

        /* Gaya tombol kembali */
        .back-link {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Detail Pegawai</h1>

        <table class="detail-table">
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $employee->nama_lengkap }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $employee->email }}</td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $employee->nomor_telepon }}</td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td>{{ $employee->tanggal_lahir }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $employee->alamat }}</td>
            </tr>
            <tr>
                <th>Tanggal Masuk</th>
                <td>{{ $employee->tanggal_masuk }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $employee->status }}</td>
            </tr>
        </table>

        <a href="{{ route('employees.index') }}" class="back-link">Kembali ke Daftar Pegawai</a>
    </div>

</body>
</html>