<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'company',
        'phone',
        'service_interest',
        'message',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'string',
        ];
    }
}
