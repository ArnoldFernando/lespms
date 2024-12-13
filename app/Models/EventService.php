<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventService extends Model
{
    use HasFactory;

    protected $casts = [
        'image' => 'array',
    ];

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
        'image',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Replace 'user_id' with the correct foreign key
    }
}
