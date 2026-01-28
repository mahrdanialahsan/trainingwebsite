<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WaiverAcceptance extends Model
{
    protected $fillable = [
        'booking_id',
        'waiver_id',
        'accepted_sections',
        'signature_name',
        'ip_address',
        'accepted_at',
    ];

    protected function casts(): array
    {
        return [
            'accepted_sections' => 'array',
            'accepted_at' => 'datetime',
        ];
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function waiver(): BelongsTo
    {
        return $this->belongsTo(Waiver::class);
    }
}
