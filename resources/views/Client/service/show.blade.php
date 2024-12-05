<x-client-layout>
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

                <div class="text-center d-flex justify-content-between">
                    <a href="{{ route('client.service.index') }}" class="btn btn-primary">Back to Services</a>
                    <!-- Form to book the service -->
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#bookingModal-{{ $eventService->id }}">
                        Book Service
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="bookingModal-{{ $eventService->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="bookingModalLabel-{{ $eventService->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="bookingModalLabel-{{ $eventService->id }}">Book
                                    Service</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('client.bookings.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="event_service_id" value="{{ $eventService->id }}">

                                    <div class="form-group">
                                        <label for="booking_date-{{ $eventService->id }}">Select Booking
                                            Date:</label>
                                        <input type="date" id="booking_date-{{ $eventService->id }}"
                                            name="booking_date" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="notes-{{ $eventService->id }}">Additional
                                            Notes:</label>
                                        <textarea id="notes-{{ $eventService->id }}" name="notes" class="form-control" placeholder="Any special requests"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Book Service</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

</x-client-layout>
