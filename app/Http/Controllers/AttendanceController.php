<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index() {
        $attendances = \App\Models\Attendance::with('employee')->latest()->paginate(10);
        return view('attendances.index', compact('attendances'));
    }

    public function create() {
        $employees = \App\Models\Employee::all();
        return view('attendances.create', compact('employees'));
    }

    /**
     * Get today's attendance status for an employee
     */
    public function getStatus($employeeId)
    {
        $today = now()->toDateString();
        $attendance = \App\Models\Attendance::where('employee_id', $employeeId)
            ->whereDate('tanggal', $today)
            ->first();

        return response()->json(['attendance' => $attendance]);
    }

    public function store(Request $request) {
        // Redirect to clockIn since we no longer use manual input
        return $this->clockIn($request);
    }

    /**
     * Clock in (automatic waktu_masuk = now) for given employee.
     */
    public function clockIn(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        $employeeId = $request->input('employee_id');
        $today = now()->toDateString();

        $attendance = \App\Models\Attendance::where('employee_id', $employeeId)
            ->whereDate('tanggal', $today)
            ->first();

        if ($attendance && $attendance->waktu_masuk) {
            return redirect()->back()->with('error', 'Karyawan sudah melakukan absen masuk hari ini.');
        }

        if (! $attendance) {
            $attendance = \App\Models\Attendance::create([
                'employee_id' => $employeeId,
                'tanggal' => $today,
                'waktu_masuk' => now()->format('H:i'),
                'status_absensi' => 'hadir',
            ]);
        } else {
            $attendance->waktu_masuk = now()->format('H:i');
            if (! $attendance->status_absensi) $attendance->status_absensi = 'hadir';
            $attendance->save();
        }

        return redirect()->back()->with('success', 'Absen masuk tercatat pada ' . now()->format('H:i'));
    }

    /**
     * Clock out (automatic waktu_keluar = now) for given employee.
     */
    public function clockOut(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        $employeeId = $request->input('employee_id');
        $today = now()->toDateString();

        $attendance = \App\Models\Attendance::where('employee_id', $employeeId)
            ->whereDate('tanggal', $today)
            ->first();

        if (! $attendance || ! $attendance->waktu_masuk) {
            return redirect()->back()->with('error', 'Belum ada absen masuk hari ini untuk karyawan ini.');
        }

        if ($attendance->waktu_keluar) {
            return redirect()->back()->with('error', 'Karyawan sudah melakukan absen keluar hari ini.');
        }

        $attendance->waktu_keluar = now()->format('H:i');
        $attendance->save();

        return redirect()->back()->with('success', 'Absen keluar tercatat pada ' . now()->format('H:i'));
    }

    /**
     * Automatic clock: decide whether to clock in or clock out for given employee.
     */
    public function autoClock(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        $employeeId = $request->input('employee_id');
        $employee = \App\Models\Employee::find($employeeId);

        // Block if employee not active or on leave
        if (! $employee) {
            return redirect()->back()->with('error', 'Karyawan tidak ditemukan.');
        }
        if ($employee->status === 'nonaktif' || $employee->status === 'cuti') {
            return redirect()->back()->with('error', 'Tidak dapat melakukan absensi otomatis untuk karyawan dengan status ' . strtoupper($employee->status));
        }

        $today = now()->toDateString();

        $attendance = \App\Models\Attendance::where('employee_id', $employeeId)
            ->whereDate('tanggal', $today)
            ->first();

        // If no attendance yet -> clock in
        if (! $attendance) {
            \App\Models\Attendance::create([
                'employee_id' => $employeeId,
                'tanggal' => $today,
                'waktu_masuk' => now()->format('H:i'),
                'status_absensi' => 'hadir',
            ]);

            return redirect()->back()->with('success', 'Absen masuk tercatat pada ' . now()->format('H:i'));
        }

        // If already clocked in but not yet clocked out -> clock out
        if ($attendance->waktu_masuk && ! $attendance->waktu_keluar) {
            $attendance->waktu_keluar = now()->format('H:i');
            $attendance->save();
            return redirect()->back()->with('success', 'Absen keluar tercatat pada ' . now()->format('H:i'));
        }

        // Already has both times
        return redirect()->back()->with('error', 'Karyawan sudah selesai absen hari ini.');
    }

   public function edit(\App\Models\Attendance $attendance) {
        $employees = \App\Models\Employee::all();
        return view('attendances.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, \App\Models\Attendance $attendance) {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after:waktu_masuk',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendances.index');
    }

    public function destroy(\App\Models\Attendance $attendance) {
        $attendance->delete();
        return redirect()->route('attendances.index');
    }
}
