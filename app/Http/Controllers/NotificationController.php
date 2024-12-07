<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function getNotifications()
    {
        $user = auth()->user();  // Get the currently authenticated user

        // Fetch unread notifications
        $notifications = $user->notifications()->where('read', false)->get();

        return response()->json([
            'new_notifications' => $notifications
        ]);
    }
}
