<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'section_type',
        'title',
        'content',
        'image_path',
        'video_path',
        'media_type',
        'order',
        'is_active',
        'additional_data',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'additional_data' => 'array',
        ];
    }
}
