<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\EventService;
use App\Models\User;

class DashboardController extends Controller
{
    public function getData()
    {
        $usersCount = User::count();
        $clientUserCount = User::where('usertype', 'user')->count();
        $serviceProviderCount = User::where('usertype', 'service_provider')->count();
        $eventServicesCount = EventService::count();
        $bookingsCount = Booking::where('status', 'confirmed')->count();
        
        return view('admin.dashboard', compact('usersCount', 'clientUserCount', 'serviceProviderCount', 'eventServicesCount', 'bookingsCount'));
    }
}
