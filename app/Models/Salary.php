<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',      // <--- MAKE SURE THIS IS HERE
        'base_salary',
        'allowance',
        'bonus',
        'deduction',
        'payment_date',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}