<x-serv-provider-layout>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Bookings for Your Services</h2>

        <!-- Non-blocked users -->
        <h3>Active Users</h3>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($nonBlockedBookings as $booking)
                <div class="col">
                    <div class="card shadow-sm">
                        @if ($booking && !empty($booking->eventService->image) && is_array($booking->eventService->image))
                            <img src="{{ asset(str_replace('public/', 'storage/', $booking->eventService->image[0])) }}"
                                alt="Event Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/img/default.png') }}" alt="Default Image" class="card-img-top"
                                style="height: 200px; object-fit: cover;">
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

                            <form method="POST" action="{{ route('user.block.service', $booking->user->id) }}"
                                onsubmit="return confirmBlockUser(event)">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    Block User
                                </button>
                            </form>

                            <script>
                                function confirmBlockUser(event) {
                                    // Display a confirmation dialog
                                    const confirmation = confirm("Are you sure you want to block this user?");
                                    if (!confirmation) {
                                        // Prevent form submission if the user cancels
                                        event.preventDefault();
                                    }
                                    return confirmation; // Return true to proceed, false to cancel
                                }
                            </script>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Blocked users -->
        <h3 class="mt-5">Blocked Users</h3>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($blockedBookings as $booking)
                <div class="col">
                    <div class="card shadow-sm">
                        @if ($booking && !empty($booking->eventService->image) && is_array($booking->eventService->image))
                            <img src="{{ asset(str_replace('public/', 'storage/', $booking->eventService->image[0])) }}"
                                alt="Event Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/img/default.png') }}" alt="Default Image" class="card-img-top"
                                style="height: 200px; object-fit: cover;">
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

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-serv-provider-layout>
