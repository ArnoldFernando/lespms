<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Mail\notifmail;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('eventService')->where('user_id', auth()->id())->get();
        return view('Client.booking.index', compact('bookings'));
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
