<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'status_absensi',
    ];

    /**
     * Mendefinisikan relasi "milik" ke model Employee.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * ACCESSOR: Menghitung total durasi kerja dalam format Jam dan Menit.
     * Akan bisa diakses melalui $attendance->durasi_kerja
     */
    protected function durasiKerja(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                if (!$attributes['waktu_masuk'] || !$attributes['waktu_keluar']) {
                    return '-';
                }
                $masuk = Carbon::parse($attributes['waktu_masuk']);
                $keluar = Carbon::parse($attributes['waktu_keluar']);
                return $masuk->diff($keluar)->format('%h jam %i menit');
            }
        );
    }


}
