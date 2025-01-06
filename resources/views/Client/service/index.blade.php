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

        <style>
            .unavailable-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                /* Semi-transparent background */
                display: flex;
                justify-content: center;
                align-items: center;
                color: white;
                font-size: 2rem;
                font-weight: bold;
                text-transform: uppercase;
                letter-spacing: 2px;
                z-index: 10;
            }
        </style>

        <!-- Page Heading -->
        <div class="d-flex align-items-center justify-content-between mb-2">
            <div>
                <h5 class="h5 mb-0 text-black">Event List</h5>

            </div>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}

            <!-- Topbar Search -->
            <div>

                <form action="{{ route('client.service.index') }}" method="GET"
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"
                            value="{{ request('query') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <hr class="mt-0">

        <div class="container-fluid">
            <!-- Check if there are services available -->
            @if ($services->isEmpty())
                <p class="text-center">No services available.</p>
            @else
                <div class="row">
                    @foreach ($services as $service)
                        @php
                            $isUnavailableNow = $service->bookings->contains(function ($booking) {
                                $today = \Carbon\Carbon::today()->toDateString();
                                $now = \Carbon\Carbon::now();

                                // Convert start_time and end_time to Carbon instances
                                $startTime = \Carbon\Carbon::parse($booking->start_time);
                                $endTime = \Carbon\Carbon::parse($booking->end_time);

                                // Check if the booking date is today, the status is confirmed, and the current time is after start_time but before end_time
                                return $booking->booking_date == $today &&
                                    $booking->status == 'confirmed' &&
                                    $startTime != null &&
                                    $endTime != null &&
                                    $now->isAfter($startTime) &&
                                    $now->isBefore($endTime);
                            });
                        @endphp



                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-light rounded position-relative"
                                @if ($isUnavailableNow) style="opacity: 0.5; pointer-events: none;" @endif>
                                @if ($isUnavailableNow)
                                    <!-- Unavailable Overlay Text -->
                                    <div class="unavailable-overlay">
                                        <span>UNAVAILABLE</span>
                                    </div>
                                @endif

                                <div class="card-header p-0">
                                    @if ($service && !empty($service->image) && is_array($service->image))
                                        <img src="{{ asset(str_replace('public/', 'storage/', $service->image[0])) }}"
                                            alt="Service Image" class="card-img-top"
                                            style="height: 200px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('assets/img/default.png') }}" alt="Default Image"
                                            class="card-img-top" style="height: 200px; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center fw-bold">{{ $service->title }}</h5>
                                    <p class="card-text"><strong>Description:</strong>
                                        {{ Str::limit($service->description, 20) }}</p>
                                    <p class="card-text"><strong>Location:</strong>
                                        {{ Str::limit($service->location, 20) }}</p>

                                    <div class="star-rating">
                                        @php
                                            $averageRating = $service->ratingsAndFeedback->avg('rating');
                                            $ratingCount = $service->ratingsAndFeedback->count();
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($averageRating))
                                                <span class="fa fa-star checked"></span>
                                            @elseif ($i == ceil($averageRating) && $averageRating - floor($averageRating) >= 0.5)
                                                <span class="fa fa-star-half-alt checked"></span>
                                            @else
                                                <span class="fa fa-star"></span>
                                            @endif
                                        @endfor
                                        <span>({{ $ratingCount }} {{ Str::plural('rating', $ratingCount) }})</span>
                                    </div>

                                    <style>
                                        .star-rating .fa-star,
                                        .star-rating .fa-star-half-alt {
                                            font-size: 1.5em;
                                            color: #ddd;
                                        }

                                        .star-rating .fa-star.checked,
                                        .star-rating .fa-star-half-alt.checked {
                                            color: #f5b301;
                                        }
                                    </style>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <!-- View Details Button -->
                                    <a href="{{ route('client.service.show', $service->id) }}"
                                        class="btn btn-info btn-sm" @if ($service->status == 'unavailable') disabled @endif>
                                        <i class="fas fa-eye"></i> View Details
                                    </a>

                                    <!-- Book Service Button -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#bookingModal-{{ $service->id }}" {{--  @if ($service->status == 'unavailable') disabled @endif>  --}} <i
                                        class="fas fa-calendar-check"></i> Book Service
                                    </button>
                                </div>

                                <!-- Chat with Service Provider -->
                                <a href="{{ route('client.chat', ['receiverId' => $service->service_provider_id]) }}"
                                    class="btn btn-success btn-sm d-block mt-1 mb-2 mx-2 text-center"
                                    {{--  @if ($service->status == 'unavailable') disabled @endif>  --}} <i class="fas fa-comment-alt"></i> Chat with Service Provider
                                </a>

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
                                                            name="booking_date" class="form-control" required
                                                            @if ($service->status == 'unavailable') disabled @endif>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="start_time-{{ $service->id }}">Start Time:</label>
                                                        <input type="time" id="start_time-{{ $service->id }}"
                                                            name="start_time" class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="end_time-{{ $service->id }}">End Time:</label>
                                                        <input type="time" id="end_time-{{ $service->id }}"
                                                            name="end_time" class="form-control" required>
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
                                                    <button type="submit" class="btn btn-primary">Book Service
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination Links -->
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        <nav>
                            {{ $services->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                </div>

            @endif
        </div>





    </div>
</x-client-layout>
