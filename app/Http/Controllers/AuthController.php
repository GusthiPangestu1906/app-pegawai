<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Position;

class AuthController extends Controller
{
    // --- LOGIN PEGAWAI (TANPA PASSWORD) ---
    public function showLoginForm()
    {
        $positions = Position::with('department')->get();
        return view('auth.login', compact('positions'));
    }

    public function login(Request $request)
    {
        // 1. Validasi Input (Sekarang pakai Email)
        $request->validate([
            'email' => 'required|email', // Ubah validasi ke email
            'position_id' => 'required|exists:positions,id',
        ]);

        // 2. Cari User berdasarkan Email dan Jabatan
        $user = User::where('email', $request->email) // Cari kolom email
                    ->where('position_id', $request->position_id)
                    ->where('role', 'employee') // Pastikan hanya employee
                    ->first();

        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('employee.dashboard');
        }

        return back()->withErrors([
            'login_error' => 'Email atau Jabatan tidak sesuai dengan data pegawai.',
        ])->onlyInput('email');
    }

    // --- LOGIN ADMIN (PAKAI PASSWORD) ---
    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun Anda tidak memiliki akses Administrator.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // --- LOGOUT ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}