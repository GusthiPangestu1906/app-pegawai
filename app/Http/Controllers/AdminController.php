<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use App\Models\employee;
use App\Models\Salary;
// Jika Anda sudah punya Model lain (Employee, Department, dll), import di sini.
// Untuk sementara kita pakai User sebagai contoh data statistik.

class AdminController extends Controller
{
    public function index()
    {
        // Contoh data statistik dummy (nanti diganti dengan data real dari database)
        $stats = [
            'employees' => User::where('role', 'employee')->count(),
            'departments' => 5, // Contoh static
            'positions' => 12,  // Contoh static
            'salaries' => 'Rp 150M' // Contoh static
        ];

        return view('admin.dashboard', compact('stats'));
    }
}