<x-serv-provider-layout>
    <div class="container">
        <h1 class="mb-4">{{ $eventService->title }}</h1>

        <div class="card">
            <div class="card-header">
                <h5>Event Service Details</h5>
            </div>
            <div class="card-body">
                <!-- Displaying all images if available -->


                <p><strong>Description:</strong> {{ $eventService->description }}</p>
                <p><strong>Rate:</strong> ${{ $eventService->rate }}</p>
                <p><strong>Status:</strong> {{ ucfirst($eventService->status) }}</p>
                <p><strong>Assigned To:</strong> {{ $eventService->assigned_to }}</p>
                <p><strong>Location:</strong> {{ $eventService->location }}</p>
                <p><strong>Special Requests:</strong> {{ $eventService->special_requests }}</p>
                <p><strong>Service Provider ID:</strong> {{ $eventService->service_provider_id }}</p>

                @if ($eventService->scheduled_date)
                    <p><strong>Scheduled Date:</strong> {{ $eventService->scheduled_date }}</p>
                @else
                    <p><strong>Scheduled Date:</strong> Not scheduled</p>
                @endif

                @if ($eventService->available_until)
                    <p><strong>Available Until:</strong> {{ $eventService->available_until }}</p>
                @else
                    <p><strong>Available Until:</strong> N/A</p>
                @endif


                <div class="row mb-4">
                    @if (isset($eventService->image) && count($eventService->image) > 0)
                        @foreach ($eventService->image as $image)
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

                <div class="text-center">
                    <a href="{{ route('services.index') }}" class="btn btn-primary">Back to Services</a>
                    <a href="{{ route('services.edit', $eventService->id) }}" class="btn btn-warning">Edit Service</a>

                    <!-- Form to delete the service -->
                    <form action="{{ route('services.destroy', $eventService->id) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this service?')">Delete
                            Service</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-serv-provider-layout>
