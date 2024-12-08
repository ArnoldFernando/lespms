<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use Carbon\Carbon;

class NotificationController extends Controller
{    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // TODO: Add styling for this blade
        $notifications = Notification::all();
        return view('service.notifications.index', compact('notifications'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)

    // TODO: Add styling for this blade
    {

        $notification = Notification::findOrFail($id);
        //
        $notification->update(['read' => true]);
        return view('service.notifications.show', compact('notification'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
    }



public function getRecentNotifications()
{
    $oneMinuteAgo = Carbon::now()->subMinute(); 

    $notification = Notification::where('user_id', auth()->id())
        ->where('created_at', '>=', $oneMinuteAgo)
        ->where('read', false)
        ->orderBy('created_at', 'desc')->get();

    
    return response()->json(['notification' => $notification]);
}

}
