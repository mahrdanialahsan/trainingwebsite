<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Waiver extends Model
{
    protected $fillable = [
        'title',
        'content',
        'pdf_path',
        'is_active',
        'version',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function acceptances(): HasMany
    {
        return $this->hasMany(WaiverAcceptance::class);
    }

    public function getSectionsAttribute(): array
    {
        $content = json_decode($this->content, true);
        return $content['sections'] ?? [];
    }
}
