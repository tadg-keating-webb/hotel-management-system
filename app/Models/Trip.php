<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'slug',
        'description',
        'long_description',
        'price',
        'duration',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getDurationAttribute($value): string
    {
        return $value .  ' day' . ($value > 1 ? 's' : '');
    }

    public function getImagesAttribute($value): array
    {
        return json_decode($value);
    }
}
