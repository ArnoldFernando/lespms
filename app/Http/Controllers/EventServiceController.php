<?php

namespace App\Http\Controllers;

use App\Models\EventService;
use App\Http\Requests\StoreEventServiceRequest;
use App\Http\Requests\UpdateEventServiceRequest;

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
        $request['service_provider_id'] = auth()->id(); 
        EventService::create($request->all());
        
        return redirect()->route('services.index')->with('success', 'Event Service created successfully.');
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
        $eventService->update($request->all());

        return redirect()->route('services.index')->with('success', 'Event Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eventService = EventService::findOrFail($id);
        $eventService->delete();

        return redirect()->route('services.index')->with('success', 'Event Service deleted successfully.');

    }
}
