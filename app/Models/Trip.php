<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'description',
        'long_description',
        'price',
        'duration',
        'image',
    ];

    protected $casts = [
        'image' => 'array',
    ];
}
