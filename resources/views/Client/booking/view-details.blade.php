<x-client-layout>
    <div class="container">
        <h1 class="mb-4">{{ $eventService->eventService->title }}</h1>

        <div class="card">
            <div class="card-header">
                <h5>Event Service Details</h5>
            </div>
            <div class="card-body">
                <!-- Displaying all images if available -->


                <p><strong>Description:</strong> {{ $eventService->eventService->description }}</p>
                <p><strong>Rate:</strong> ${{ $eventService->eventService->rate }}</p>
                <p><strong>Status:</strong> {{ ucfirst($eventService->eventService->status) }}</p>
                <p><strong>Assigned To:</strong> {{ $eventService->eventService->assigned_to }}</p>
                <p><strong>Location:</strong> {{ $eventService->eventService->location }}</p>
                <p><strong>Special Requests:</strong> {{ $eventService->eventService->special_requests }}</p>
                <p><strong>Service Provider ID:</strong> {{ $eventService->eventService->service_provider_id }}</p>

                @if ($eventService->eventService->scheduled_date)
                    <p><strong>Scheduled Date:</strong> {{ $eventService->eventService->scheduled_date }}</p>
                @else
                    <p><strong>Scheduled Date:</strong> Not scheduled</p>
                @endif

                @if ($eventService->eventService->available_until)
                    <p><strong>Available Until:</strong> {{ $eventService->eventService->available_until }}</p>
                @else
                    <p><strong>Available Until:</strong> N/A</p>
                @endif


                <div class="row mb-4">
                    @if (isset($eventService->eventService->image) && count($eventService->eventService->image) > 0)
                        @foreach ($eventService->eventService->image as $image)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset(str_replace('public/', 'storage/', $image)) }}" alt="Event Image"
                                    class="img-fluid" style="width: 100%; height: 200px; object-fit: cover;">
                            </div>
                        @endforeach
                    @else
                        <!-- Display default image if no images are available -->
                        <div class="col-md-4 mb-3">
                            <img src="{{ asset('assets/default.png') }}" alt="Default Image" class="img-fluid"
                                style="width: 100%; height: 200px; object-fit: cover;">
                        </div>
                    @endif
                </div>
                <hr>
            </div>
        </div>
    </div>
</x-client-layout>
