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

Route::get('/', function () {
    return redirect('/login');
});

// --- AUTHENTICATION ---
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

// --- GROUP ADMIN DASHBOARD (WITH prefix name 'admin.') ---
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.') 
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    });

// --- GROUP ADMIN RESOURCES (WITHOUT prefix name 'admin.') ---
// Separate group to ensure resource names are clean (e.g., 'employees.index')
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    // NO ->name('admin.') HERE
    ->group(function () {
        
        Route::resource('employees', EmployeeController::class)->names([
            'index' => 'employees.index',
            'create' => 'employees.create',
            'store' => 'employees.store',
            'show' => 'employees.show',
            'edit' => 'employees.edit',
            'update' => 'employees.update',
            'destroy' => 'employees.destroy',
        ]);

        Route::resource('departments', DepartmentController::class)->names([
            'index' => 'departments.index',
            'create' => 'departments.create',
            'store' => 'departments.store',
            'show' => 'departments.show',
            'edit' => 'departments.edit',
            'update' => 'departments.update',
            'destroy' => 'departments.destroy',
        ]);

        Route::resource('positions', PositionController::class)->names([
            'index' => 'positions.index',
            'create' => 'positions.create',
            'store' => 'positions.store',
            'show' => 'positions.show',
            'edit' => 'positions.edit',
            'update' => 'positions.update',
            'destroy' => 'positions.destroy',
        ]);

        Route::resource('salaries', SalaryController::class)->names([
            'index' => 'salaries.index',
            'create' => 'salaries.create',
            'store' => 'salaries.store',
            'show' => 'salaries.show',
            'edit' => 'salaries.edit',
            'update' => 'salaries.update',
            'destroy' => 'salaries.destroy',
        ]);
        
        // Fix for 'attendances.index' not defined error
        Route::resource('attendances', AttendanceController::class)->names([
            'index' => 'attendances.index',
            'create' => 'attendances.create',
            'store' => 'attendances.store',
            'show' => 'attendances.show',
            'edit' => 'attendances.edit',
            'update' => 'attendances.update',
            'destroy' => 'attendances.destroy',
        ]);
    });

// --- GROUP EMPLOYEE ---
Route::middleware(['auth', 'role:employee'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {
        Route::get('/dashboard', [AttendanceController::class, 'index'])->name('dashboard');
        Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    });

Route::get('/presensi', [AttendanceController::class, 'showGuestForm'])->name('presensi.form');
Route::post('/presensi', [AttendanceController::class, 'submitGuestAttendance'])->name('presensi.submit');

Route::get('/', function () {
    return redirect('/presensi'); // Bisa diubah redirect ke presensi jika mau halaman utamanya ini
});