<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultingSection extends Model
{
    protected $fillable = [
        'section_type',
        'title',
        'content',
        'subtitle',
        'button_text',
        'button_link',
        'additional_data',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'additional_data' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
