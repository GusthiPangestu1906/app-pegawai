<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. HALAMAN UTAMA -> LANGSUNG KE LOGIN
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. AUTHENTICATION
Route::controller(AuthController::class)->group(function () {
    // Login Pegawai (Nama & Jabatan)
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');

    // Login Admin (Email & Password)
    Route::get('/admin/login', 'showAdminLoginForm')->name('admin.login');
    Route::post('/admin/login', 'adminLogin');

    Route::post('/logout', 'logout')->name('logout');
});

// 3. GROUP ADMIN (HR)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // --- TAMBAHKAN RUTE INI (KHUSUS UPLOAD FOTO) ---
    Route::patch('/employees/{id}/update-photo', [EmployeeController::class, 'updatePhoto'])->name('employees.update-photo');

    // Resource Routes Pegawai
    Route::resource('employees', EmployeeController::class)->names([
        'index' => 'employees.index',
        'create' => 'employees.create',
        'store' => 'employees.store',
        'show' => 'employees.show',
        'edit' => 'employees.edit',
        'update' => 'employees.update',
        'destroy' => 'employees.destroy',
    ]);

    // Resource Routes (Tanpa prefix nama 'admin.')
    Route::resource('employees', EmployeeController::class)->names([
        'index' => 'employees.index', 'create' => 'employees.create', 'store' => 'employees.store',
        'show' => 'employees.show', 'edit' => 'employees.edit', 'update' => 'employees.update', 'destroy' => 'employees.destroy'
    ]);

    Route::resource('departments', DepartmentController::class)->names([
        'index' => 'departments.index', 'create' => 'departments.create', 'store' => 'departments.store',
        'show' => 'departments.show', 'edit' => 'departments.edit', 'update' => 'departments.update', 'destroy' => 'departments.destroy'
    ]);

    Route::resource('positions', PositionController::class)->names([
        'index' => 'positions.index', 'create' => 'positions.create', 'store' => 'positions.store',
        'show' => 'positions.show', 'edit' => 'positions.edit', 'update' => 'positions.update', 'destroy' => 'positions.destroy'
    ]);

    Route::resource('salaries', SalaryController::class)->names([
        'index' => 'salaries.index', 'create' => 'salaries.create', 'store' => 'salaries.store',
        'show' => 'salaries.show', 'edit' => 'salaries.edit', 'update' => 'salaries.update', 'destroy' => 'salaries.destroy'
    ]);

    Route::patch('salaries/{salary}/approve', [SalaryController::class, 'approve'])->name('salaries.approve');
});

// 4. GROUP EMPLOYEE (PEGAWAI) & HISTORY
Route::middleware(['auth'])->group(function () {
    // Dashboard Pegawai
    Route::get('/employee/dashboard', [AttendanceController::class, 'index'])->name('employee.dashboard');
    
    // History Presensi (Ini yang tadi error 'Route not defined')
    // Pastikan namanya 'employee.history' sesuai panggilan di view, atau ubah panggilan di view jadi 'history'
    // Kita pakai 'history' saja biar simpel, nanti view disesuaikan.
    Route::get('/employee/history', [AttendanceController::class, 'history'])->name('history'); 

    // Proses Simpan Presensi
    Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
});