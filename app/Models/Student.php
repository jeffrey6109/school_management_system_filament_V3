<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\Race;
use App\Enums\Religion;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $casts = [
        'date_of_birth' => 'datetime',
        'gender' => Gender::class,
        'religion' => Religion::class,
        'race' => Race::class,
        'status' => Status::class,
    ];

    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'religion',
        'race',
        'status',
        'nationality',
        'ic_no',
        'address_1',
        'address_2',
        'home_phone',
        'mobile_phone',
        'email',
    ];
}
