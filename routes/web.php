<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalaryController;

Route::resource('employees', EmployeeController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('positions', PositionController::class);
Route::resource('attendances', AttendanceController::class);
// Quick clock-in / clock-out endpoints (automatic waktu_masuk / waktu_keluar)
Route::post('attendances/clock-in', [AttendanceController::class, 'clockIn'])->name('attendances.clockin');
Route::post('attendances/clock-out', [AttendanceController::class, 'clockOut'])->name('attendances.clockout');
Route::get('api/attendance/status/{employee}', [AttendanceController::class, 'getStatus'])->name('attendances.status');
Route::resource('salaries', SalaryController::class);