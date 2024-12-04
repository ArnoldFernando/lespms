<x-serv-provider-layout>
    <div class="container">
        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($eventService))
                @method('PUT') <!-- Use PUT for updates -->
            @endif

            <div class="form-group">
                <label for="title">Service Title</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ isset($eventService) ? $eventService->title : old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ isset($eventService) ? $eventService->description : old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="rate">Rate</label>
                <input type="number" name="rate" id="rate" class="form-control"
                    value="{{ isset($eventService) ? $eventService->rate : old('rate') }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="available"
                        {{ isset($eventService) && $eventService->status == 'available' ? 'selected' : '' }}>Available
                    </option>
                    <option value="in-progress"
                        {{ isset($eventService) && $eventService->status == 'in-progress' ? 'selected' : '' }}>In
                        Progress</option>
                    <option value="completed"
                        {{ isset($eventService) && $eventService->status == 'completed' ? 'selected' : '' }}>Completed
                    </option>
                    <option value="canceled"
                        {{ isset($eventService) && $eventService->status == 'canceled' ? 'selected' : '' }}>Canceled
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="scheduled_date">Scheduled Date</label>
                <input type="date" name="scheduled_date" id="scheduled_date" class="form-control"
                    value="{{ isset($eventService) ? $eventService->scheduled_date : old('scheduled_date') }}">
            </div>

            <div class="form-group">
                <label for="available_until">Available Until</label>
                <input type="date" name="available_until" id="available_until" class="form-control"
                    value="{{ isset($eventService) ? $eventService->available_until : old('available_until') }}">
            </div>

            <div class="form-group">
                <label for="assigned_to">Assigned To</label>
                <input type="text" name="assigned_to" id="assigned_to" class="form-control"
                    value="{{ isset($eventService) ? $eventService->assigned_to : old('assigned_to') }}">
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" class="form-control"
                    value="{{ isset($eventService) ? $eventService->location : old('location') }}">
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

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image[]" id="image" multiple>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($eventService) ? 'Update' : 'Create' }} Event
                Service</button>
        </form>
    </div>
</x-serv-provider-layout>
