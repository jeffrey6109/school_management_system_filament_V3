<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'certificate_image',
        'original_filename',
    ];

    protected $casts = [
        'certificate_image' => 'array',
        'original_filename' => 'array',
    ];
}
