<x-client-layout>
    <div class="container-fluid">


        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    showConfirmButton: true,
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    showConfirmButton: true,
                });
            </script>
        @endif


        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h5 class="h5 mb-0 text-gray-800">Event Details</h5>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <hr class="mt-0">
        <div class="row mb-1">
            <div class="col-6 d-flex justify-content-start">
                <a href="{{ route('client.service.index') }}" class="btn btn-primary"><i
                        class="fa-solid fa-arrow-left me-1"></i>Back to Services</a>

            </div>
            <div class="col-6 d-flex justify-content-end">
                <button type="button" class="btn btn-warning" data-toggle="modal"
                    data-target="#bookingModal-{{ $eventService->id }}">
                    Book Service
                </button>
            </div>
        </div>

        <hr class="mt-0">

        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                @if (isset($eventService->image) && count($eventService->image) > 0)
                    @foreach ($eventService->image as $image)
                        <div class="col-md-4 mb-3">
                            <img src="{{ asset(str_replace('public/', 'storage/', $image)) }}" alt="Event Image"
                                class="img-fluid rounded-1" style="width: 100%; height: 200px; object-fit: cover;">
                        </div>
                    @endforeach
                @else
                    <!-- Display default image if no images are available -->
                    <div class="col-md-4 mb-3">
                        <img src="{{ asset('assets/img/logo2.jpg') }}" alt="Default Image" class="img-fluid rounded-1"
                            style="width: 100%; height: 200px; object-fit: cover;">
                    </div>
                @endif
            </div>
            <div class="col-12 d-flex justify-content-center">
                <h3 class="mb-4">" {{ $eventService->title }} "</h3>
                <hr>
            </div>
            <div class="col-12">
                <p><strong>Description:</strong> {{ $eventService->description }}</p>
                <p><strong>Rate:</strong> ${{ $eventService->rate }}</p>
                <p><strong>Status:</strong> {{ ucfirst($eventService->status) }}</p>
                <p><strong>Assigned To:</strong> {{ $eventService->assigned_to }}</p>
                <p><strong>Location:</strong> {{ $eventService->location }}</p>
                <p><strong>Special Requests:</strong> {{ $eventService->special_requests }}</p>
                <p><strong>Service Provider ID:</strong> {{ $eventService->service_provider_id }}</p>

                @if ($eventService->scheduled_date)
                    <p><strong>Scheduled Date:</strong>
                        {{ \Carbon\Carbon::parse($eventService->scheduled_date)->format('F j, Y') }}</p>
                @else
                    <p><strong>Scheduled Date:</strong> Not scheduled</p>
                @endif

                @if ($eventService->available_until)
                    <p><strong>Available Until:</strong>
                        {{ \Carbon\Carbon::parse($eventService->available_until)->format('F j, Y') }}</p>
                @else
                    <p><strong>Available Until:</strong> N/A</p>
                @endif

            </div>


            <!-- Modal -->
            <div class="modal fade" id="bookingModal-{{ $eventService->id }}" tabindex="-1" role="dialog"
                aria-labelledby="bookingModalLabel-{{ $eventService->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bookingModalLabel-{{ $eventService->id }}">Book Service
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('client.bookings.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="event_service_id" value="{{ $eventService->id }}">

                                <div class="form-group">
                                    <label for="booking_date-{{ $eventService->id }}">Select Booking Date:</label>
                                    <input type="date" id="booking_date-{{ $eventService->id }}" name="booking_date"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="notes-{{ $eventService->id }}">Additional Notes:</label>
                                    <textarea id="notes-{{ $eventService->id }}" name="notes" class="form-control" placeholder="Any special requests"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Book Service</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- </div> --}}
    </div>
</x-client-layout>
