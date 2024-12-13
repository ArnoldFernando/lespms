<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;

class BlockuserController extends Controller
{
    //

    public function index()
    {
        // Fetch distinct users who booked the service provider's services
        $bookedUsers = Booking::whereHas('eventService', function ($query) {
            $query->where('service_provider_id', auth()->user()->id);
        })
            ->with('user')
            ->get()
            ->unique('user_id'); // Get unique records based on user_id

        // Pass the data to the view
        return view('service.blocked.index', compact('bookedUsers'));
    }

    public function blockUser($userId)
    {
        // Find the user by ID
        $user = User::find($userId);

        // Check if the user exists
        if (!$user) {
            return back()->withErrors('User not found.');
        }

        // Block the user and store the ID of the service provider who blocked them
        $user->is_blocked = true;
        $user->blocked_by = auth()->user()->id;
        $user->save();

        return back()->with('success', 'User has been blocked.');
    }


    public function unblockUser($userId)
    {
        // Find the user and unblock them
        $user = User::findOrFail($userId);
        $user->is_blocked = false;
        $user->save();

        return redirect()->back()->with('success', 'User has been unblocked successfully.');
    }



    public function blockUserFromServices($userId)
    {
        // Find the user by ID
        $user = User::find($userId);

        // Check if the user exists
        if (!$user) {
            return back()->withErrors('User not found.');
        }

        // Block the user and store the ID of the service provider who blocked them
        $user->is_blocked = true;
        $user->blocked_by = auth()->user()->id;
        $user->save();

        return back()->with('success', 'User has been blocked.');
    }

    public function usersWhoAvailed()
    {
        // Ensure the logged-in user is a service provider
        if (auth()->user()->role !== 'service provider') {
            return redirect('/')->withErrors('You do not have permission to view this data.');
        }

        // Fetch users who availed the service
        $users = User::whereHas('services', function ($query) {
            $query->where('provider_id', auth()->user()->id); // Ensure it's the current service provider's services
        })->get();

        // Pass the users to the view
        return view('services.users-who-availed', compact('users'));
    }
}
