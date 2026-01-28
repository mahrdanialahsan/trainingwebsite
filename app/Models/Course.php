<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'long_description',
        'thumbnail_image',
        'date',
        'start_time',
        'end_time',
        'price',
        'max_participants',
        'status',
        'is_active',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            if (empty($course->slug) && !empty($course->title)) {
                $slug = Str::slug($course->title);
                $originalSlug = $slug;
                $counter = 1;
                
                // Ensure uniqueness
                while (Course::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                
                $course->slug = $slug;
            }
        });

        static::updating(function ($course) {
            if (($course->isDirty('title') && empty($course->slug)) || empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'start_time' => 'datetime',
            'end_time' => 'datetime',
            'price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function isUpcoming(): bool
    {
        return $this->status === 'upcoming' && $this->date >= now()->toDateString();
    }

    public function canBeBooked(): bool
    {
        return $this->is_active && $this->isUpcoming() && 
               ($this->max_participants === null || $this->bookings()->where('status', '!=', 'cancelled')->count() < $this->max_participants);
    }
}
