<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\Race;
use App\Enums\Religion;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $casts = [
        'date_of_birth' => 'datetime',
        'gender' => Gender::class,
        'religion' => Religion::class,
        'race' => Race::class,
        'status' => Status::class,
        'vitals' => 'json',
    ];

    protected $fillable = [
        'student_id',
        'name',
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
        'standard_id',
        'vitals',
    ];

    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }

    public function guardians(): BelongsToMany
    {
        return $this->belongsToMany(Guardian::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(CertificateStudent::class);
    }
}
