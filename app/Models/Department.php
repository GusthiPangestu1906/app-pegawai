<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    // Relasi ke Jabatan
    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    // Relasi ke Pegawai (User)
    public function users()
    {
        return $this->hasMany(User::class);
    }
}