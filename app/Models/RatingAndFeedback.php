<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingAndFeedback extends Model
{
    use HasFactory;

    protected $table = 'ratings_and_feedback';

    protected $fillable = [
        'event_service_id',
        'user_id',
        'rating',
        'feedback',
    ];

    public function service()
    {
        return $this->belongsTo(EventService::class, 'event_service_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
