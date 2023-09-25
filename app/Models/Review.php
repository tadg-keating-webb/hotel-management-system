<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'review',
        'rating',
        'approved',
    ];

    protected $casts = [
        'created_at' => 'datetime:F j, Y, H:i A',
    ];
}
