<x-client-layout>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h5 class="h5 mb-0 text-black">Event List</h5>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <hr class="mt-0">

        <div class="container-fluid">
            <!-- Put your code here -->

            @if ($services->isEmpty())
                <p>No services available.</p>
            @else
                <div class="row">
                    @foreach ($services as $service)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    @if ($service && !empty($service->image) && is_array($service->image))
                                        <img src="{{ asset(str_replace('public/', 'storage/', $service->image[0])) }}"
                                            alt="Image" style="width: 100%; height: 150px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('assets/img/default.png') }}" alt="Default Image"
                                            style="width: 100%; height: 150px; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><strong>Description:</strong> {{ $service->title }}</p>
                                    <p class="card-text"><strong>Location:</strong> {{ $service->location }}</p>
                                </div>
                                <div class="card-footer">
                                    <!-- View Details Button -->
                                    <a href="{{ route('client.service.show', $service->id) }}" class="btn btn-info">View
                                        Details</a>

                                    <!-- Book Service Button -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#bookingModal-{{ $service->id }}">
                                        Book Service
                                    </button>


                                    <a href="{{ route('chat', ['receiverId' => $service->service_provider_id]) }}"
                                        class="btn btn-info mt-2">
                                        Chat with Service provider
                                    </a>

                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="bookingModal-{{ $service->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="bookingModalLabel-{{ $service->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="bookingModalLabel-{{ $service->id }}">Book
                                                    Service</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('client.bookings.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="event_service_id"
                                                        value="{{ $service->id }}">

                                                    <div class="form-group">
                                                        <label for="booking_date-{{ $service->id }}">Select Booking
                                                            Date:</label>
                                                        <input type="date" id="booking_date-{{ $service->id }}"
                                                            name="booking_date" class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="notes-{{ $service->id }}">Additional
                                                            Notes:</label>
                                                        <textarea id="notes-{{ $service->id }}" name="notes" class="form-control" placeholder="Any special requests"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Book Service</button>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</x-client-layout>
