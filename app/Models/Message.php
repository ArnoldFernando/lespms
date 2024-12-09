<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    // Add the 'sender_id' to the fillable property
    protected $fillable = [
        'sender_id', // Add sender_id here
        'receiver_id',
        'message',
        'chat_room_id', // Include other fields if needed
        'created_at',
        'updated_at',
    ];

    use HasFactory;
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
