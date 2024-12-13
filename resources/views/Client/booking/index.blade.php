<x-client-layout>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h5 class="h5 mb-0 text-gray-800">Booking List</h5>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <hr class="mt-0">

        <div class="container-fluid">
            <!-- Put your code here -->
            <div class="row g-4">
                @if ($bookings->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-primary text-center">
                            No bookings available at the moment book a service now.
                            <a href="{{ route('client.service.index') }}">Book now</a>
                        </div>
                    </div>
                @else
                    @foreach ($bookings as $booking)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card shadow-sm">
                                @if ($booking && !empty($booking->eventService->image) && is_array($booking->eventService->image))
                                    <img src="{{ asset(str_replace('public/', 'storage/', $booking->eventService->image[0])) }}"
                                        alt="Event Image" class="card-img-top"
                                        style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/img/default.png') }}" alt="Default Image"
                                        class="card-img-top" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $booking->eventService->title }}</h5>
                                    <p class="card-text">Date: {{ $booking->booking_date }}</p>
                                    <p class="card-text">Status:
                                        <span
                                            class="badge
                                        {{ $booking->status == 'confirmed'
                                            ? 'bg-success'
                                            : ($booking->status == 'pending'
                                                ? 'bg-warning'
                                                : 'bg-danger') }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </p>
                                    <a href="{{ route('client.bookings.show', $booking->id) }}"
                                        class="btn btn-info">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif
            </div>
        </div>

    </div>

</x-client-layout>
