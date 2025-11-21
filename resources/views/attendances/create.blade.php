@extends('master')
@section('title', 'Tambah Absensi')
@section('page-title', 'Tambah Absensi')

@section('content')
<style>
    .form-container { max-width: 600px; margin: auto; padding: 30px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-weight: 600; margin-bottom: 8px; }
    .form-group input, .form-group select { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
    .btn-submit { display: block; width: 100%; padding: 12px; background-color: #0d6efd; color: white; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; }
</style>

<div class="form-container">
    @if(session('error'))
        <div class="alert alert-danger" style="margin-bottom: 20px; padding: 15px; border-radius: 4px; background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24;">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 20px; padding: 15px; border-radius: 4px; background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724;">
            {{ session('success') }}
        </div>
    @endif

    <form id="clock-form">
        @csrf
        <div class="form-group">
            <label for="employee_id">Nama Pegawai</label>
            <select name="employee_id" id="employee_id" required>
                <option value="">-- Pilih Pegawai --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ ($employee->status === 'nonaktif' || $employee->status === 'cuti') ? 'disabled' : '' }}>
                        {{ $employee->nama_lengkap }} ({{ strtoupper($employee->status) }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status absensi hari ini --}}
        <div id="attendance-status" class="form-group" style="display:none;margin-bottom:20px;padding:15px;border-radius:4px;background-color:#e9ecef;border:1px solid #dee2e6;">
            <strong>Status Absensi Hari Ini:</strong>
            <div id="status-text">-</div>
        </div>

        {{-- Tombol Absen --}}
        <div style="display:flex;gap:10px;">
            <button type="button" id="btn-clockin" class="btn-submit" style="background-color:#198754" onclick="submitAbsen('in')" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right:8px">
                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                </svg>
                Absen Masuk
            </button>
            <button type="button" id="btn-clockout" class="btn-submit" style="background-color:#dc3545" onclick="submitAbsen('out')" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right:8px">
                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                </svg>
                Absen Keluar
            </button>
        </div>
    </form>

    {{-- Hidden forms for submitting --}}
    <form id="clockin-form" action="{{ route('attendances.clockin') }}" method="POST" style="display:none">
        @csrf
        <input type="hidden" name="employee_id" id="clockin-employee-id">
    </form>
    <form id="clockout-form" action="{{ route('attendances.clockout') }}" method="POST" style="display:none">
        @csrf
        <input type="hidden" name="employee_id" id="clockout-employee-id">
    </form>

    <script>
        (function(){
            const select = document.getElementById('employee_id');
            const btnIn = document.getElementById('btn-clockin');
            const btnOut = document.getElementById('btn-clockout');
            const statusDiv = document.getElementById('attendance-status');
            const statusText = document.getElementById('status-text');
            
            // Cek status absensi ketika karyawan dipilih
            select.addEventListener('change', async function() {
                const employeeId = this.value;
                btnIn.disabled = true;
                btnOut.disabled = true;
                statusDiv.style.display = 'none';
                
                if (!employeeId) return;

                try {
                    const response = await fetch(`/api/attendance/status/${employeeId}`);
                    const data = await response.json();
                    
                    statusDiv.style.display = 'block';
                    
                    if (!data.attendance) {
                        statusText.innerHTML = 'Belum absen hari ini';
                        btnIn.disabled = false;
                        btnOut.disabled = true;
                    } else if (data.attendance.waktu_masuk && !data.attendance.waktu_keluar) {
                        statusText.innerHTML = `Absen masuk: ${data.attendance.waktu_masuk}`;
                        btnIn.disabled = true;
                        btnOut.disabled = false;
                    } else if (data.attendance.waktu_masuk && data.attendance.waktu_keluar) {
                        statusText.innerHTML = `Absen masuk: ${data.attendance.waktu_masuk}<br>Absen keluar: ${data.attendance.waktu_keluar}`;
                        btnIn.disabled = true;
                        btnOut.disabled = true;
                    }
                } catch (error) {
                    console.error('Error:', error);
                    statusText.innerHTML = 'Error mengambil status absensi';
                }
            });

            // Submit form absensi
            window.submitAbsen = function(type) {
                const employeeId = select.value;
                if (!employeeId) {
                    alert('Pilih karyawan terlebih dahulu');
                    return;
                }

                const form = document.getElementById(`clock${type}-form`);
                const input = document.getElementById(`clock${type}-employee-id`);
                input.value = employeeId;
                form.submit();
            };
        })();
    </script>
    <script>
        (function(){
            const btnIn = document.getElementById('btn-clockin');
            const btnOut = document.getElementById('btn-clockout');
            const select = document.getElementById('employee_id');
            const clockInForm = document.getElementById('clockin-form');
            const clockOutForm = document.getElementById('clockout-form');
            const clockInInput = document.getElementById('clockin-employee-id');
            const clockOutInput = document.getElementById('clockout-employee-id');

            function submitClock(formInput, form) {
                const val = select.value;
                if (!val) {
                    alert('Pilih pegawai terlebih dahulu.');
                    return;
                }
                formInput.value = val;
                form.submit();
            }

            btnIn.addEventListener('click', function(){ submitClock(clockInInput, clockInForm); });
            btnOut.addEventListener('click', function(){ submitClock(clockOutInput, clockOutForm); });
        })();
    </script>
</div>
@endsection