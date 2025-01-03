<x-serv-provider-layout>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h5 class="h5 mb-0 text-black">Event Service Details</h5>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <hr class="mt-0">

        {{-- <div class="container-fluid"> --}}
        <div class="row mb-1">
            <div class="col-6 d-flex justify-content-start">
                <a href="{{ route('service-provider.services.index') }}" class="btn btn-primary">Back to Services</a>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('service-provider.services.edit', $eventService->id) }}"
                    class="btn btn-warning me-1">Edit
                    Service</a>

                <!-- Form to delete the service -->
                <form action="{{ route('service-provider.services.destroy', $eventService->id) }}" method="POST"
                    style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this service?')">Delete
                        Service</button>
                </form>
            </div>
        </div>
        <hr class="mt-0">
        <!-- Put your code here -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                {{-- <div class="row mb-4"> --}}
                @if (isset($eventService->image) && count($eventService->image) > 0)
                    @foreach ($eventService->image as $image)
                        <div class="col-md-4 mb-3">
                            <img src="{{ asset(str_replace('public/', 'storage/', $image)) }}" alt="Event Image"
                                class="img-fluid rounded-1" style="width: 200%; height: 200px; object-fit: cover;">
                        </div>
                    @endforeach
                @else
                    <!-- Display default image if no images are available -->
                    <div class="col-md-4 mb-3">
                        <img src="{{ asset('assets/img/default.png') }}" alt="Default Image" class="img-fluid rounded-1"
                            style="width: 100%; height: 200px; object-fit: cover;">
                    </div>
                @endif
                {{-- </div> --}}
            </div>
            <div class="col-12 d-flex justify-content-center">
                <h3 class="mb-4">" {{ $eventService->title }} "</h3>
                <hr>
            </div>

            <div class="col-12">
                <p><strong>Description:</strong> {{ $eventService->description }}</p>
                <p><strong>Rate:</strong> ${{ $eventService->rate }}</p>
                <p><strong>Number of Guests:</strong> {{ $eventService->number_of_guests }} Guest</p>
                <p><strong>Status:</strong> {{ ucfirst($eventService->status) }}</p>
                <p><strong>Assigned To:</strong> {{ $eventService->assigned_to }}</p>
                <p><strong>Location:</strong> {{ $eventService->location }}</p>
                <p><strong>Special Requests:</strong> {{ $eventService->special_requests }}</p>
                <p><strong>Service Provider ID:</strong> {{ $eventService->service_provider_id }}</p>

                @if ($eventService->scheduled_date)
                    <p><strong>Scheduled Date:</strong>
                        {{ \Carbon\Carbon::parse($eventService->scheduled_date)->format('F d, Y') }}</p>
                @else
                    <p><strong>Scheduled Date:</strong> Not scheduled</p>
                @endif

                @if ($eventService->available_until)
                    <p><strong>Available Until:</strong>
                        {{ \Carbon\Carbon::parse($eventService->available_until)->format('F d, Y') }}</p>
                @else
                    <p><strong>Available Until:</strong> N/A</p>
                @endif

            </div>

            <div class="col-12">

            </div>

            <div class="col-12 text-center">

            </div>
        </div>

        {{-- </div> --}}

    </div>
</x-serv-provider-layout>
