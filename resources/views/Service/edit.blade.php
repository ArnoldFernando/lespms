<x-serv-provider-layout>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h5 class="h5 mb-0 text-black">Title</h5>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <hr class="mt-0">

        <form action="{{ route('services.update', $eventService->id, 'data') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- Form Fields -->
            <div class="form-group">
                <label for="title">Service Title</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ $eventService->title ?? old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ $eventService->description ?? old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col 3">
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="number" name="rate" id="rate" class="form-control"
                            value="{{ $eventService->rate ?? old('rate') }}" required>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="available"
                                {{ isset($eventService) && $eventService->status == 'available' ? 'selected' : '' }}>
                                Available
                            </option>
                            <option value="in-progress"
                                {{ isset($eventService) && $eventService->status == 'in-progress' ? 'selected' : '' }}>
                                In
                                Progress</option>
                            <option value="completed"
                                {{ isset($eventService) && $eventService->status == 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>
                            <option value="canceled"
                                {{ isset($eventService) && $eventService->status == 'canceled' ? 'selected' : '' }}>
                                Canceled
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="scheduled_date">Scheduled Date</label>
                        <input type="date" name="scheduled_date" id="scheduled_date" class="form-control"
                            value="{{ isset($eventService) ? $eventService->scheduled_date : old('scheduled_date') }}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="available_until">Available Until</label>
                        <input type="date" name="available_until" id="available_until" class="form-control"
                            value="{{ isset($eventService) ? $eventService->available_until : old('available_until') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="assigned_to">Assigned To</label>
                        <input type="text" name="assigned_to" id="assigned_to" class="form-control"
                            value="{{ isset($eventService) ? $eventService->assigned_to : old('assigned_to') }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" class="form-control"
                            value="{{ isset($eventService) ? $eventService->location : old('location') }}">
                    </div>
                </div>
            </div>






            <div class="form-group">
                <label for="special_requests">Special Requests</label>
                <textarea name="special_requests" id="special_requests" class="form-control" rows="3">{{ isset($eventService) ? $eventService->special_requests : old('special_requests') }}</textarea>
            </div>

            <div class="form-group">
                <label for="is_featured">Is Featured</label>
                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                    {{ isset($eventService) && $eventService->is_featured ? 'checked' : '' }}>
            </div>
            <!-- Image Upload Section -->
            <!-- Current Images -->
            <div class="form-group">
                <label>Current Images</label>
                <div class="row">
                    @if (empty($eventService->image) || count($eventService->image) === 0)
                        <p>No image uploaded</p>
                    @else
                        @foreach ($eventService->image as $imagePath)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="{{ asset(str_replace('public/', 'storage/', $imagePath)) }}"
                                        alt="Event Image" class="card-img-top"
                                        style="max-height: 150px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <label>
                                            <input type="checkbox" name="delete_image[]" value="{{ $imagePath }}">
                                            Remove
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- New Images -->
            <div class="form-group">
                <label for="image">Add New Images</label>
                <input type="file" name="image[]" id="image" class="form-control" multiple>
                <small class="form-text text-muted">You can upload multiple images.</small>
            </div>


            <button type="submit" class="btn btn-primary">Update Event Service</button>
        </form>

    </div>

</x-serv-provider-layout>
