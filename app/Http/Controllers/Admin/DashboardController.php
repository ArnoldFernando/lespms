<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\EventService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getData()
    {
        // Insights Data
        $usersCount = User::count();
        $clientUserCount = User::where('usertype', 'user')->count();
        $serviceProviderCount = User::where('usertype', 'service_provider')->count();
        $adminCount = User::where('usertype', 'admin')->count();

        $eventServicesCount = EventService::count();
        $activeServices = EventService::where('status', 'active')->count();
        $inactiveServices = EventService::where('status', 'inactive')->count();
        $featuredServices = EventService::where('is_featured', true)->count();

        $blockedUsers = User::where('is_blocked', true)->count();
        $activeUsers = $usersCount - $blockedUsers;

        // Monthly Bookings
        $monthlyBookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $months = range(1, 12);
        $bookingsPerMonth = [];
        foreach ($months as $month) {
            $bookingsPerMonth[] = $monthlyBookings[$month] ?? 0;
        }

        return view('admin.dashboard', [
            'usersCount' => $usersCount,
            'clientUserCount' => $clientUserCount,
            'serviceProviderCount' => $serviceProviderCount,
            'adminCount' => $adminCount,
            'eventServicesCount' => $eventServicesCount,
            'activeServices' => $activeServices,
            'inactiveServices' => $inactiveServices,
            'featuredServices' => $featuredServices,
            'blockedUsers' => $blockedUsers,
            'activeUsers' => $activeUsers,
            'bookingsPerMonth' => $bookingsPerMonth,
        ]);
    }
}
