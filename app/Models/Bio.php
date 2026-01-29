<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Full URL for the bio photo (works with public_html and storage link).
     */
    public function getPhotoUrlAttribute(): ?string
    {
        if (empty($this->photo)) {
            return null;
        }
        return Storage::disk('public')->exists($this->photo)
            ? Storage::disk('public')->url($this->photo)
            : null;
    }
}
