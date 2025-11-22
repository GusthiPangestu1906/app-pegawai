<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Position; // Import model Position

class AuthController extends Controller
{
    // Tampilkan Form Login
    public function showLoginForm()
    {
        // Kita butuh data jabatan untuk dropdown di halaman login
        $positions = Position::with('department')->get();
        return view('auth.login', compact('positions'));
    }

    // Proses Login (Custom: Nama & Jabatan)
    public function login(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string',
            'position_id' => 'required|exists:positions,id',
        ]);

        // 2. Cari User berdasarkan Nama dan Jabatan
        $user = User::where('name', $request->name)
                    ->where('position_id', $request->position_id)
                    ->first();

        // 3. Logika Login
        if ($user) {
            // Jika data cocok, login-kan user secara manual tanpa cek password
            Auth::login($user);
            $request->session()->regenerate();

            // Redirect sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('employee.dashboard');
            }
        }

        // 4. Jika data tidak ditemukan
        return back()->withErrors([
            'login_error' => 'Nama atau Jabatan tidak sesuai dengan database.',
        ])->onlyInput('name');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}