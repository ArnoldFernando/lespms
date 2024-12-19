<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\EventService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreEventServiceRequest;
use App\Http\Requests\UpdateEventServiceRequest;
use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class EventServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $services = EventService::where('service_provider_id', auth()->id())->get();
        return view('service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventServiceRequest $request)
    {

        $user_id = Auth::id();

        $imagePaths = [];

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('event_images'), $imageName); // Move directly to 'public' directory
                $imagePaths[] = 'event_images/' . $imageName; // Store relative path for easy access
            }
        }
        EventService::create([
            'service_provider_id' => $user_id,
            'title' => $request->title,
            'description' => $request->description,
            'rate' => $request->rate,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
            'location' => $request->location,
            'special_requests' => $request->special_requests,
            'is_featured' => $request->is_featured,
            'image' => $imagePaths,
        ]);

        return redirect()->route('service-provider.services.index')->with('success', 'Event Service created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $eventService = EventService::findOrFail($id);


        return view('service.show', compact('eventService'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $eventService = EventService::findOrFail($id);


        return view('service.edit', compact('eventService'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventServiceRequest $request, string $id)
    {
        $eventService = EventService::findOrFail($id);
        $imagePaths = $eventService->image;

        // Handle image deletions
        if ($request->has('delete_image')) {
            $imagePaths = array_filter($imagePaths, function ($path) use ($request) {
                return !in_array($path, $request->delete_image);
            });
        }

        // // Handle new image uploads
        // if ($request->hasFile('image')) {
        //     foreach ($request->file('image') as $imageFile) {
        //         // Store in 'public/event_images' directory
        //         $path = $imageFile->store('event_images', 'public');
        //         $imagePaths[] = $path;
        //     }
        // }

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('event_images'), $imageName); // Move directly to 'public' directory
                $imagePaths[] = 'event_images/' . $imageName; // Store relative path for easy access
            }
        }


        // Update the event service
        $eventService->update([
            'title' => $request->title,
            'description' => $request->description,
            'rate' => $request->rate,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
            'location' => $request->location,
            'special_requests' => $request->special_requests,
            'is_featured' => $request->is_featured,
            'image' => array_values($imagePaths), // Re-index the array
        ]);

        return redirect()->route('service-provider.services.index')->with('updated-success', 'Event Service updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eventService = EventService::findOrFail($id);
        $eventService->delete();
        return redirect()->route('service-provider.services.index')->with('success', 'Event Service deleted successfully.');
    }

    public function deleteImage($id, $key)
    {
        $event = EventService::findOrFail($id);

        // Ensure $event->images is always an array
        $images = is_string($event->images) ? json_decode($event->images, true) : $event->images;

        if (isset($images[$key])) {
            // Remove the image from the array
            unset($images[$key]);

            // Update the images field in the database
            $event->images = json_encode(array_values($images)); // Reindex the array
            $event->save();

            return redirect()->back()->with('success', 'Image removed from the database successfully.');
        }

        return redirect()->back()->with('error', 'Image not found.');
    }


    public function showBookings()
    {
        // Fetch all bookings for the authenticated service provider
        $bookings = Booking::with('eventService', 'user')->where('status', 'pending')
            ->whereHas('eventService', function ($query) {
                $query->where('service_provider_id', auth()->id());
            })
            ->get();

        // Separate bookings into blocked and non-blocked users
        $nonBlockedBookings = $bookings->filter(function ($booking) {
            return !$booking->user->is_blocked; // Non-blocked users
        });

        $blockedBookings = $bookings->filter(function ($booking) {
            return $booking->user->is_blocked; // Blocked users
        });

        // Pass both collections to the view
        return view('Service.booked-service.index', compact('nonBlockedBookings', 'blockedBookings'));
    }


    public function showConfirmedBookings()
    {
        // Fetch all bookings for the authenticated service provider
        $bookings = Booking::with('eventService', 'user')->where('status', 'confirmed')
            ->whereHas('eventService', function ($query) {
                $query->where('service_provider_id', auth()->id());
            })
            ->get();

        // Separate bookings into blocked and non-blocked users
        $nonBlockedBookings = $bookings->filter(function ($booking) {
            return !$booking->user->is_blocked; // Non-blocked users
        });

        $blockedBookings = $bookings->filter(function ($booking) {
            return $booking->user->is_blocked; // Blocked users
        });

        // Pass both collections to the view
        return view('Service.status.confirmed', compact('nonBlockedBookings', 'blockedBookings'));
    }



    public function showCanceledBookings()
    {
        // Fetch all bookings for the authenticated service provider
        $bookings = Booking::with('eventService', 'user')->where('status', 'canceled')
            ->whereHas('eventService', function ($query) {
                $query->where('service_provider_id', auth()->id());
            })
            ->get();

        // Separate bookings into blocked and non-blocked users
        $nonBlockedBookings = $bookings->filter(function ($booking) {
            return !$booking->user->is_blocked; // Non-blocked users
        });

        $blockedBookings = $bookings->filter(function ($booking) {
            return $booking->user->is_blocked; // Blocked users
        });

        // Pass both collections to the view
        return view('Service.booked-service.index', compact('nonBlockedBookings', 'blockedBookings'));
    }



    public function updateStatus($bookingId, $status)
    {
        // Valid statuses for booking
        $validStatuses = ['canceled', 'confirmed'];

        // Check if the status is valid
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status');
        }

        // Fetch the booking
        $booking = Booking::findOrFail($bookingId);

        // Update the booking status
        $booking->status = $status;
        $booking->save();

        // If the booking is confirmed, update the associated event service status to 'unavailable'
        if ($status == 'confirmed') {
            $eventService = EventService::find($booking->event_service_id); // Assuming there's an 'event_service_id' on the booking model

            if ($eventService) {
                $eventService->status = 'unavailable';
                $eventService->save();
            }
        }

        // Create a notification for the user
        Notification::create([
            'user_id' => $booking->user_id, // User who made the booking
            'message' => 'Your booking has been ' . $status,
            'booked_by_user_id' => auth()->id(), // Admin or service provider who updated the status
            'read' => false,
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Booking status updated successfully, and the user has been notified.');
    }



    public function updateConfirmedStatus($bookingId, $status)
    {
        // Valid statuses for booking
        $validStatuses = ['canceled', 'confirmed', 'completed'];

        // Check if the status is valid
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status');
        }

        // Fetch the booking
        $booking = Booking::findOrFail($bookingId);

        // Update the booking status
        $booking->status = $status;
        $booking->save();

        // If the booking is confirmed, update the associated event service status to 'unavailable'
        if ($status == 'confirmed') {
            $eventService = EventService::find($booking->event_service_id); // Assuming there's an 'event_service_id' on the booking model

            if ($eventService) {
                $eventService->status = 'unavailable'; // Mark as unavailable when confirmed
                $eventService->save();
            }
        }

        // If the booking is completed, update the associated event service status to 'available'
        if ($status == 'completed') {
            $eventService = EventService::find($booking->event_service_id);

            if ($eventService) {
                $eventService->status = 'available'; // Mark as available when completed
                $eventService->save();
            }
        }

        // Create a notification for the user
        Notification::create([
            'user_id' => $booking->user_id, // User who made the booking
            'message' => 'Your booking has been ' . $status,
            'booked_by_user_id' => auth()->id(), // Admin or service provider who updated the status
            'read' => false,
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Booking status updated successfully, and the user has been notified.');
    }
}
