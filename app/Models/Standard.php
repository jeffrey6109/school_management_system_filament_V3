<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Standard extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'class_number'];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
