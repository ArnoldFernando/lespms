<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\EventService;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
    public function index()
    {
        $ServicesCount = EventService::where('service_provider_id', Auth::id())->count();
        $BookingsCount = Booking::with('eventService', 'user')
            ->whereHas('eventService', function ($query) {
                $query->where('service_provider_id', auth()->id());
            })
            ->count();

        $ConfirmedBookingsCount = Booking::with('eventService', 'user')
            ->whereHas('eventService', function ($query) {
                $query->where('service_provider_id', auth()->id());
            })
            ->where('status', 'confirmed')  // Filter by the 'confirmed' status
            ->count();

        $PendingBookingsCount = Booking::with('eventService', 'user')
            ->whereHas('eventService', function ($query) {
                $query->where('service_provider_id', auth()->id());
            })
            ->where('status', 'pending')  
            ->count();

            //TODO: make the dashboard view better

        return view('service.dashboard', compact('ServicesCount', 'BookingsCount', 'ConfirmedBookingsCount', 'PendingBookingsCount'));
    }

}
