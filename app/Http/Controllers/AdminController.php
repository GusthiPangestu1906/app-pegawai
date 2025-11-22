<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use App\Models\Attendance;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // 1. STATISTIK KARTU
        $stats = [
            'employees' => User::where('role', 'employee')->count(),
            'departments' => Department::count(),
            'positions' => Position::count(),
            'present_today' => Attendance::where('date', $today)->where('status', 'present')->count(),
            'absent_today' => Attendance::where('date', $today)->whereIn('status', ['sick', 'permission'])->count(),
        ];

        // 2. LOG AKTIVITAS TERBARU (Tabel)
        $recent_attendances = Attendance::with('user')
                                        ->where('date', $today)
                                        ->orderBy('updated_at', 'desc')
                                        ->take(5)
                                        ->get();

        return view('admin.dashboard', compact('stats', 'recent_attendances'));
    }
}