<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use App\Models\Salary; // Jangan lupa import Model Salary
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Departemen
        $deptIT = Department::create(['name' => 'Information Technology', 'description' => 'Divisi Teknologi & Sistem']);
        $deptHR = Department::create(['name' => 'Human Resources', 'description' => 'Divisi SDM & Rekrutmen']);
        $deptFin = Department::create(['name' => 'Finance', 'description' => 'Divisi Keuangan & Akuntansi']);
        $deptMkt = Department::create(['name' => 'Marketing', 'description' => 'Divisi Pemasaran & Penjualan']);
        $deptGA = Department::create(['name' => 'General Affair', 'description' => 'Divisi Umum & Fasilitas']);
        $deptExec = Department::create(['name' => 'Executive', 'description' => 'Jajaran Direksi']);

        // 2. Buat Jabatan (Positions) & Gaji Dasar
        // IT
        $posITMgr = Position::create(['department_id' => $deptIT->id, 'title' => 'IT Manager', 'basic_salary' => 20000000]);
        $posBack = Position::create(['department_id' => $deptIT->id, 'title' => 'Backend Developer', 'basic_salary' => 15000000]);
        $posFront = Position::create(['department_id' => $deptIT->id, 'title' => 'Frontend Developer', 'basic_salary' => 14000000]);
        $posUI = Position::create(['department_id' => $deptIT->id, 'title' => 'UI/UX Designer', 'basic_salary' => 13000000]);
        $posSys = Position::create(['department_id' => $deptIT->id, 'title' => 'System Administrator', 'basic_salary' => 12000000]);

        // HR
        $posHRMgr = Position::create(['department_id' => $deptHR->id, 'title' => 'HR Manager', 'basic_salary' => 18000000]);
        $posRec = Position::create(['department_id' => $deptHR->id, 'title' => 'Recruitment Staff', 'basic_salary' => 8000000]);
        $posPay = Position::create(['department_id' => $deptHR->id, 'title' => 'Payroll Specialist', 'basic_salary' => 9000000]);

        // Finance
        $posFinMgr = Position::create(['department_id' => $deptFin->id, 'title' => 'Finance Manager', 'basic_salary' => 19000000]);
        $posAcc = Position::create(['department_id' => $deptFin->id, 'title' => 'Accountant', 'basic_salary' => 10000000]);
        $posFinStaff = Position::create(['department_id' => $deptFin->id, 'title' => 'Finance Staff', 'basic_salary' => 7500000]);

        // Marketing
        $posMktMgr = Position::create(['department_id' => $deptMkt->id, 'title' => 'Marketing Manager', 'basic_salary' => 17000000]);
        $posSales = Position::create(['department_id' => $deptMkt->id, 'title' => 'Sales Executive', 'basic_salary' => 6000000]);
        $posDigital = Position::create(['department_id' => $deptMkt->id, 'title' => 'Digital Marketer', 'basic_salary' => 9500000]);
        $posContent = Position::create(['department_id' => $deptMkt->id, 'title' => 'Content Creator', 'basic_salary' => 8500000]);

        // GA
        $posGASpv = Position::create(['department_id' => $deptGA->id, 'title' => 'GA Supervisor', 'basic_salary' => 10000000]);
        $posOB = Position::create(['department_id' => $deptGA->id, 'title' => 'Office Boy', 'basic_salary' => 4800000]);
        $posDriver = Position::create(['department_id' => $deptGA->id, 'title' => 'Driver', 'basic_salary' => 5500000]);

        // Executive
        $posCEO = Position::create(['department_id' => $deptExec->id, 'title' => 'Chief Executive Officer', 'basic_salary' => 50000000]);
        $posCTO = Position::create(['department_id' => $deptExec->id, 'title' => 'Chief Technology Officer', 'basic_salary' => 45000000]);


        // 3. Buat User (Pegawai) & Input Gaji Otomatis
        $password = Hash::make('password'); // Password default: 'password'
        $today = Carbon::now();

        // --- Admin Utama ---
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@hr.com',
            'password' => $password,
            'role' => 'admin',
            'department_id' => $deptHR->id,
            'position_id' => $posHRMgr->id,
            'birth_date' => '1990-01-01',
        ]);

        // Fungsi Helper lokal untuk membuat user dan gaji sekaligus
        $createEmployee = function ($name, $email, $departmentId, $position, $birthDate) use ($password, $today) {
            // Buat User
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role' => 'employee',
                'department_id' => $departmentId,
                'position_id' => $position->id,
                'birth_date' => $birthDate,
            ]);

            // Buat Data Gaji (Base Salary dari Jabatan, Tunjangan 10%, Bonus Random)
            Salary::create([
                'user_id' => $user->id,
                'base_salary' => $position->basic_salary,
                'allowance' => $position->basic_salary * 0.1, // Tunjangan 10%
                'bonus' => 0,
                'deduction' => 0,
                'payment_date' => $today,
            ]);
        };

        // --- Executive ---
        $createEmployee('Hartono Wijaya', 'ceo@company.com', $deptExec->id, $posCEO, '1975-05-20');
        $createEmployee('Sarah Adiningrat', 'cto@company.com', $deptExec->id, $posCTO, '1980-08-15');

        // --- HRD ---
        $createEmployee('Budi Santoso', 'budi@hr.com', $deptHR->id, $posHRMgr, '1985-03-10');
        $createEmployee('Diana Pungky', 'diana@hr.com', $deptHR->id, $posRec, '1992-11-05');
        $createEmployee('Eko Patrio', 'eko@hr.com', $deptHR->id, $posPay, '1988-07-22');

        // --- IT ---
        $createEmployee('Gusthi Pangestu', 'gusthi@it.com', $deptIT->id, $posITMgr, '1995-01-30');
        $createEmployee('Kevin Sanjaya', 'kevin@it.com', $deptIT->id, $posBack, '1996-09-12');
        $createEmployee('Marcus Gideon', 'marcus@it.com', $deptIT->id, $posFront, '1994-04-18');
        $createEmployee('Putri Tanjung', 'putri@it.com', $deptIT->id, $posUI, '1998-12-01');
        $createEmployee('Dedy Corbuzier', 'dedy@it.com', $deptIT->id, $posSys, '1982-06-25');

        // --- Finance ---
        $createEmployee('Sri Mulyani', 'sri@finance.com', $deptFin->id, $posFinMgr, '1978-10-10');
        $createEmployee('Siti Aminah', 'siti@finance.com', $deptFin->id, $posFinStaff, '1993-02-14');
        $createEmployee('Bambang Pamungkas', 'bambang@finance.com', $deptFin->id, $posAcc, '1986-05-05');

        // --- Marketing ---
        $createEmployee('Raffi Ahmad', 'raffi@marketing.com', $deptMkt->id, $posMktMgr, '1987-02-17');
        $createEmployee('Joko Anwar', 'joko@sales.com', $deptMkt->id, $posSales, '1984-08-29');
        $createEmployee('Nagita Slavina', 'nagita@marketing.com', $deptMkt->id, $posDigital, '1989-10-10');
        $createEmployee('Raditya Dika', 'radit@marketing.com', $deptMkt->id, $posContent, '1991-12-28');

        // --- GA ---
        $createEmployee('Rina Nose', 'rina@ga.com', $deptGA->id, $posGASpv, '1990-07-07');
        $createEmployee('Sule Prikitiw', 'sule@ga.com', $deptGA->id, $posOB, '1985-11-15');
        $createEmployee('Andre Taulany', 'andre@ga.com', $deptGA->id, $posDriver, '1983-09-17');
    }
}