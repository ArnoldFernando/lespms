<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Mail\notifmail;
use App\Models\Booking;
use App\Models\EventService;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['eventService' => function ($query) {
                $query->select('id', 'service_provider_id');
            }, 'user' => function ($query) {
                $query->select('id', 'is_blocked');
            }]);
        $query->orderBy('booking_date');

        $allowedStatuses = ['pending', 'confirmed', 'canceled', 'completed'];  // Define the allowed statuses

        if (auth()->user()->usertype === "service_provider") {
         // Check if the request has a valid status and filter based on the allowed statuses
            if ($request->has('status') && in_array($request->input('status'), $allowedStatuses)) {
                $query->where('status', $request->input('status'));
            } else {
                // Redirect back with an error message if the status is invalid
                return redirect()->route('service-provider.bookings.index', ['status' => 'pending'])
                                ->with('error', 'Invalid status. Allowed statuses are: pending, confirmed, or canceled.');
            }

            $bookings = $query->get();
            $nonBlockedBookings = $bookings->where('user.is_blocked', false);
            $blockedBookings = $bookings->where('user.is_blocked', true);

            return view('Service.booked-service.index', compact('nonBlockedBookings', 'blockedBookings'));
        }

        if (auth()->user()->usertype === "user") {
            $bookings = $query->with('eventService')->get();

            return view('Client.booking.index', compact('bookings'));
        }

        return redirect()->route('home');
    }


    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);
        $status = $request->status;

        $validStatuses = ['pending', 'confirmed', 'canceled', 'completed'];
        
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status');
        }


        $booking->status = $status;
        $booking->save();

        if ($status == 'confirmed') {
            $eventService = EventService::find($booking->event_service_id);

            if ($eventService) {
                $eventService->status = 'unavailable';
                $eventService->save();
            }
        }

        if ($status == 'completed') {
            $eventService = EventService::find($booking->event_service_id);

            if ($eventService) {
                $eventService->status = 'available';
                $eventService->save();
            }
        }

        Notification::create([
            'user_id' => $booking->user_id,
            'message' => 'Your booking has been ' . $status,
            'booked_by_user_id' => auth()->id(),
            'read' => false,
        ]);

        return redirect()->back()->with('success', 'Booking status updated successfully, and the user has been notified.');

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input (uncomment if needed)
        // $request->validate([
        //     'event_service_id' => 'required|exists:event_services,id',
        //     'booking_date' => 'required|date|after:today',
        //     'notes' => 'nullable|string',
        // ]);

        // Create a booking
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'event_service_id' => $request->event_service_id,
            'booking_date' => $request->booking_date,
            'notes' => $request->notes,
        ]);

        // Notify the service provider
        $serviceProvider = User::find($booking->eventService->service_provider_id);
        if ($serviceProvider) {
            // Create a notification for the service provider
            $serviceProvider->notifications()->create([
                'message' => 'A new booking has been made for your service: ' . $booking->eventService->title,
                'read' => false,
                'booked_by_user_id' => Auth::id(),
            ]);

            // Prepare the booking details for the email
            $bookingDetails = [
                'name' => auth()->user()->name, // Logged-in user's name (the one who booked)
                'email' => auth()->user()->email, // Logged-in user's email
                'service' => $booking->eventService->title, // Service name
                'date' => $booking->booking_date, // Booking date
                'notes' => $booking->notes, // Optional notes from the booking
            ];

            // Send email notification to the service provider
            Mail::to($serviceProvider->email)->send(new notifmail($bookingDetails));
        }

        // Respond to the AJAX request
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'A new booking has been made for your service: ' . $booking->eventService->title,
            ]);
        }

        // Redirect back for regular form submissions
        return redirect()->back()->with('success', 'Service booked successfully!');
    }

    public function show(string $id)
    {
        $booking = Booking::with('eventService')->findOrFail($id);
        $eventService = $booking->eventService;

        return view('Client.booking.show', compact('eventService'));
    }

}
