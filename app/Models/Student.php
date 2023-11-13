<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $casts = [
        'date_of_birth' => 'datetime'
    ];

    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'nationality',
        'ic_no',
        'address_1',
        'address_2',
        'home_phone',
        'mobile_phone',
        'email'
    ];
}
