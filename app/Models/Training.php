<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Training extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'about_title',
        'about_description',
        'download_button_text',
        'download_pdf_path',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function facilities(): HasMany
    {
        return $this->hasMany(TrainingFacility::class)->where('is_active', true)->orderBy('order');
    }

    public function amenities(): HasMany
    {
        return $this->hasMany(TrainingAmenity::class)->where('is_active', true)->orderBy('order');
    }
}
