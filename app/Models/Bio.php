<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bio extends Model
{
    protected $fillable = [
        'type',
        'name',
        'tagline',
        'bio',
        'email',
        'phone',
        'photo',
        'credentials',
        'experience',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
