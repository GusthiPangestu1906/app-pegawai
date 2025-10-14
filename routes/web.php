<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;

Route::resource('employees', EmployeeController::class);
Route::resource('departments', DepartmentController::class);