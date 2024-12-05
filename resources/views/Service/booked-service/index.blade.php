<x-serv-provider-layout>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h5 class="h5 mb-0 text-black">Service List</h5>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <hr class="mt-0">

        <div class="container-fluid">
            <h4 class="text-center mb-4">Bookings for Your Services</h4>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($bookings as $booking)
                    <div class="col">
                        <div class="card shadow-sm">
                            @if ($booking && !empty($booking->eventService->image) && is_array($booking->eventService->image))
                                <img src="{{ asset(str_replace('public/', 'storage/', $booking->eventService->image[0])) }}"
                                    alt="Event Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="{{ asset('assets/img/default.png') }}" alt="Default Image"
                                    class="card-img-top" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $booking->user->name }}</h5>
                                <p class="card-text">
                                    <strong>Service:</strong> {{ $booking->eventService->title }}<br>
                                    <strong>Date:</strong> {{ $booking->booking_date }}<br>
                                    <strong>Status:</strong>
                                    <span
                                        class="badge {{ $booking->status == 'confirmed' ? 'bg-success' : ($booking->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span><br>
                                    <strong>Special Requests:</strong> {{ $booking->special_requests ?? 'None' }}
                                </p>

                                @if ($booking->status == 'pending')
                                    <form
                                        action="{{ route('event-services.updateStatus', ['bookingId' => $booking->id, 'status' => 'confirmed']) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                                    </form>

                                    <form
                                        action="{{ route('event-services.updateStatus', ['bookingId' => $booking->id, 'status' => 'canceled']) }}"
                                        method="POST" class="d-inline ml-2">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-serv-provider-layout>
