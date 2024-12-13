<x-serv-provider-layout>
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
            <h5 class="h5 mb-0 text-black">Booked List</h5>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>
        <hr class="mt-0">

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h5>"Booking for your Service"</h5>
            </div>
        </div>
        <hr class="mt-0">
        <!-- Non-blocked users -->
        <h4>Active Users</h4>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach ($nonBlockedBookings as $booking)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card shadow-sm border-light">
                        <!-- Event Image -->
                        @if ($booking && !empty($booking->eventService->image) && is_array($booking->eventService->image))
                            <img src="{{ asset(str_replace('public/', 'storage/', $booking->eventService->image[0])) }}"
                                alt="Event Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/img/default.png') }}" alt="Default Image" class="card-img-top"
                                style="height: 200px; object-fit: cover;">
                        @endif

                        <!-- Card Body -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $booking->user->name }}</h5>
                            <p class="card-text">
                                <strong>Service:</strong> {{ $booking->eventService->title }}<br>
                                <strong>Date:</strong>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('F d, Y') }}<br>
                                <strong>Status:</strong>
                                <span
                                    class="badge {{ $booking->status == 'confirmed' ? 'bg-success' : ($booking->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ ucfirst($booking->status) }}
                                </span><br>
                                <strong>Special Requests:</strong> {{ $booking->special_requests ?? 'None' }}
                            </p>

                            <div class="d-flex justify-content-between">
                                <!-- Confirm / Cancel Buttons for Pending Status -->
                                @if ($booking->status == 'pending')
                                    <div>
                                        <form
                                            action="{{ route('event-services.updateStatus', ['bookingId' => $booking->id, 'status' => 'confirmed']) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                                        </form>

                                        <!-- Cancel Button to Trigger Modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmCancelModal">
                                            Cancel
                                        </button>

                                        <!-- Confirmation Modal for Canceling -->
                                        <div class="modal fade" id="confirmCancelModal" tabindex="-1"
                                            aria-labelledby="confirmCancelModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmCancelModalLabel">Confirm
                                                            Cancelation</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to cancel this event? This action cannot
                                                        be undone.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <!-- Cancel Form Inside Modal -->
                                                        <form
                                                            action="{{ route('event-services.updateStatus', ['bookingId' => $booking->id, 'status' => 'canceled']) }}"
                                                            method="POST" class="d-inline" id="cancelEventForm">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Confirm
                                                                Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif

                                <!-- Block User Button -->
                                <!-- Block User Button to Trigger Modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#confirmBlockUserModal">
                                    <i class="fa-solid fa-ban me-1"></i>Block
                                </button>

                                <!-- Confirmation Modal for Blocking User -->
                                <div class="modal fade" id="confirmBlockUserModal" tabindex="-1"
                                    aria-labelledby="confirmBlockUserModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmBlockUserModalLabel">Confirm Block
                                                    User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to block this user? They will not be able to use
                                                your services.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <!-- Block User Form in Modal -->
                                                <form method="POST"
                                                    action="{{ route('user.block.service', $booking->user->id) }}"
                                                    class="ms-3" id="blockUserForm">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Confirm Block</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Chat Button -->
                            <a href="{{ route('chat', ['receiverId' => $booking->user->id]) }}"
                                class="btn btn-info mt-2 w-100"><i class="fa-regular fa-comments me-1"></i>
                                Chat with User
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <script>
            function confirmBlockUser(event) {
                const confirmation = confirm("Are you sure you want to block this user?");
                if (!confirmation) {
                    event.preventDefault();
                }
                return confirmation;
            }
        </script>





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
