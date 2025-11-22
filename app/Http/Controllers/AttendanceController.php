<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Position;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // --- BAGIAN UNTUK DASHBOARD PEGAWAI (YANG SUDAH ADA) ---
    public function index()
    {
        // ... kode lama biarkan saja ...
        // (Hanya dipakai jika pegawai login dashboard)
    }

    public function store(Request $request)
    {
        // ... kode lama biarkan saja ...
    }

    // --- BAGIAN BARU: PRESENSI MANDIRI (TANPA LOGIN EMAIL/PASS) ---

    // 1. Tampilkan Halaman Form Presensi
    public function showGuestForm()
    {
        $positions = Position::with('department')->get();
        return view('attendance.guest', compact('positions'));
    }

    public function submitGuestAttendance(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'position_id' => 'required|exists:positions,id',
            'status' => 'required|in:present,sick,permission', // Validasi status
            'note' => 'nullable|string', // Validasi keterangan
        ]);

        $user = User::where('name', $request->name)
                    ->where('position_id', $request->position_id)
                    ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Data pegawai tidak ditemukan! Pastikan Nama dan Jabatan sesuai.');
        }

        $today = Carbon::today();
        $now = Carbon::now();

        // Cek apakah sudah ada data hari ini
        $attendance = Attendance::where('user_id', $user->id)->where('date', $today)->first();

        if ($attendance) {
            // Jika sudah ada data
            if ($attendance->status != 'present') {
                // Kalau statusnya Sakit/Izin, tolak presensi lagi
                return redirect()->back()->with('info', 'Halo ' . $user->name . ', Anda sudah tercatat ' . strtoupper($attendance->status) . ' hari ini.');
            }
            
            // Jika status Hadir tapi belum clock_out, lakukan clock_out
            if (!$attendance->clock_out && $request->status == 'present') {
                $attendance->update(['clock_out' => $now]);
                return redirect()->back()->with('success', 'Halo ' . $user->name . ', Berhasil Absen PULANG pada jam ' . $now->format('H:i'));
            }

            return redirect()->back()->with('info', 'Halo ' . $user->name . ', Anda sudah menyelesaikan presensi hari ini.');
        }

        // Jika belum ada data hari ini -> Buat Data Baru
        
        if ($request->status == 'present') {
            // Kalau Hadir -> Catat jam masuk
            Attendance::create([
                'user_id' => $user->id,
                'date' => $today,
                'clock_in' => $now,
                'status' => 'present',
            ]);
            return redirect()->back()->with('success', 'Halo ' . $user->name . ', Berhasil Absen MASUK pada jam ' . $now->format('H:i'));
        
        } else {
            // Kalau Sakit / Izin -> Jam masuk/pulang dikosongkan atau diisi null, status dicatat
            Attendance::create([
                'user_id' => $user->id,
                'date' => $today,
                'clock_in' => $now, // Tetap catat waktu lapornya
                'clock_out' => $now, // Langsung tutup hari itu
                'status' => $request->status,
                'note' => $request->note,
            ]);
            
            $statusMsg = ($request->status == 'sick') ? 'SAKIT' : 'IZIN';
            return redirect()->back()->with('success', 'Halo ' . $user->name . ', Keterangan ' . $statusMsg . ' Anda telah dicatat. Semoga lekas sembuh/urusan lancar.');
        }
    }
}