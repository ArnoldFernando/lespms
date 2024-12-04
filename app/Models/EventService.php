<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventService extends Model
{
    use HasFactory;

    protected $fillable = [
            'service_provider_id',
            'title',
            'description',
            'rate',
            'status',
            'scheduled_date',
            'available_until',
            'assigned_to',
            'location',
            'special_requests',
            'is_featured',
    ];
}
