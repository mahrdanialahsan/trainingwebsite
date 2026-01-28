<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'status',
        'waiver_accepted',
        'payment_completed',
        'notes',
        'uid',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->uid)) {
                $booking->uid = static::generateUniqueUid();
            }
        });
    }

    protected static function generateUniqueUid(): string
    {
        do {
            $uid = strtoupper(Str::random(8));
        } while (static::where('uid', $uid)->exists());

        return $uid;
    }

    public function getRouteKeyName()
    {
        return 'uid';
    }

    protected function casts(): array
    {
        return [
            'waiver_accepted' => 'boolean',
            'payment_completed' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function waiverAcceptances(): HasMany
    {
        return $this->hasMany(WaiverAcceptance::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
