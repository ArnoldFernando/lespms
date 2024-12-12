<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\EventService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $services = EventService::query();

        // If the user is blocked, return an empty collection of services
        if (auth()->check() && auth()->user()->is_blocked) {
            $services = collect();  // No services shown to blocked user
        } else {
            $services = EventService::with('user')->get();
        }

        return view('client.service.index', compact('services'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $eventService = EventService::findOrFail($id);


        return view('Client.service.show', compact('eventService'));
    }


    public function view_details(string $id)
    {
        $eventService = Booking::with('eventService')->findOrFail($id);

        return view('Client.booking.view-details', compact('eventService'));
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
