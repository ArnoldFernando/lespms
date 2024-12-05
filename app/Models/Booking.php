<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_service_id', 'booking_date', 'status', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function eventService()
    {
        return $this->belongsTo(EventService::class);
    }
}
