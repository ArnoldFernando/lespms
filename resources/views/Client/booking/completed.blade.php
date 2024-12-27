<x-client-layout>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        </script>
    @endif


    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h5 class="h5 mb-0 text-gray-800">Complete Booking List</h5>
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
                                @if (
                                    $booking &&
                                        $booking->eventService &&
                                        !empty($booking->eventService->image) &&
                                        is_array($booking->eventService->image))
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

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('client.ratings.store', $booking->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="event_service_id"
                                            value="{{ $booking->eventService->id }}">
                                        <div class="star-rating">
                                            @php
                                                $userRating =
                                                    $booking->eventService->ratingsAndFeedback->first() ?? null;
                                                $ratingValue = $userRating ? $userRating->rating : 0;
                                                $feedbackValue = $userRating ? $userRating->feedback : '';
                                            @endphp
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="star{{ $booking->id }}-{{ $i }}"
                                                    name="rating" value="{{ $i }}"
                                                    {{ $i == $ratingValue ? 'checked' : '' }} />
                                                <label for="star{{ $booking->id }}-{{ $i }}"
                                                    title="{{ $i }} star"
                                                    aria-label="{{ $i }} star rating">&#9733;</label>
                                            @endfor
                                        </div>

                                        <div class="feedback-container">
                                            <label for="feedback-{{ $booking->id }}">Feedback:</label>
                                            <textarea name="feedback" id="feedback-{{ $booking->id }}" rows="4">{{ $feedbackValue }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-2 mb-3">Submit</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <style>
                .star-rating {
                    display: inline-flex;
                    justify-content: flex-start;
                }

                .star-rating input[type="radio"] {
                    display: none;
                }

                .star-rating label {
                    font-size: 2em;
                    color: #ddd;
                    /* Default gray for unselected stars */
                    cursor: pointer;
                }

                /* Highlight stars on hover (right to left) */
                .star-rating label:hover,
                .star-rating label:hover~label {
                    color: inherit;
                    /* Reset the color of all stars */
                }

                .star-rating label:hover~label,
                .star-rating label:hover {
                    color: #f5b301;
                    /* Yellow for hovered stars */
                }


                /* Keep the selected stars highlighted */
                .star-rating input[type="radio"]:checked~label {
                    color: #f5b301;
                }


                .feedback-container {
                    margin-top: 20px;
                }

                .feedback-container label {
                    display: block;
                    margin-bottom: 5px;
                    font-weight: bold;
                }

                .feedback-container textarea {
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    resize: vertical;
                }

                .feedback-container button {
                    margin-top: 10px;
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }

                .feedback-container button:hover {
                    background-color: #0056b3;
                }
            </style>
        </div>

    </div>

</x-client-layout>
