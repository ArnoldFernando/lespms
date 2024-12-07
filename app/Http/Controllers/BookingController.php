<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Notifications\BookingNotification;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
            ]);
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


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
