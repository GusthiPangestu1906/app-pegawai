<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();
        
        $attendance = Attendance::where('user_id', $user->id)
                                ->where('date', $today)
                                ->first();

        return view('employee.dashboard', compact('attendance'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();
        $now = Carbon::now();

        $attendance = Attendance::where('user_id', $user->id)
                                ->where('date', $today)
                                ->first();

        // 1. JIKA MEMILIH SAKIT / IZIN
        if ($request->has('status') && in_array($request->status, ['sick', 'permission'])) {
            if ($attendance) {
                return redirect()->back()->with('error', 'Anda sudah melakukan presensi hari ini.');
            }

            Attendance::create([
                'user_id' => $user->id,
                'date' => $today,
                'clock_in' => null, // Tidak ada jam masuk
                'clock_out' => null, // Tidak ada jam pulang
                'status' => $request->status,
                'note' => $request->note,
            ]);

            $statusText = ($request->status == 'sick') ? 'SAKIT' : 'IZIN';
            return redirect()->back()->with('success', 'Berhasil mengajukan ' . $statusText);
        }

        // 2. JIKA PRESENSI NORMAL (HADIR)
        if (!$attendance) {
            // Absen Masuk
            Attendance::create([
                'user_id' => $user->id,
                'date' => $today,
                'clock_in' => $now,
                'status' => 'present',
            ]);
            return redirect()->back()->with('success', 'Berhasil Absen MASUK pada ' . $now->format('H:i'));
        } elseif (!$attendance->clock_out && $attendance->status == 'present') {
            // Absen Pulang
            $attendance->update([
                'clock_out' => $now,
            ]);
            return redirect()->back()->with('success', 'Berhasil Absen PULANG pada ' . $now->format('H:i'));
        }

        return redirect()->back()->with('error', 'Anda sudah menyelesaikan presensi hari ini.');
    }

    public function history()
    {
        $user = Auth::user();
        $attendances = Attendance::where('user_id', $user->id)
                                ->orderBy('date', 'desc')
                                ->get();

        return view('employee.history', compact('attendances'));
    }
}