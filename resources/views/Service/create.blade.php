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
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h5 class="h5 mb-0 text-black">Add Event</h5>
        </div>
        <hr class="mt-0">
        <div class="container-fluid">
            <form action="{{ route('service-provider.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                @if (isset($eventService))
                    @method('PUT')
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
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="rate">Rate per hour (Peso)</label>
                            <input type="number" name="rate" id="rate" class="form-control"
                                value="{{ isset($eventService) ? $eventService->rate : old('rate') }}" required>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="rate">Number of guest (Total person to Accomodate)</label>
                            <input type="number" name="number_of_guests" id="number_of_guests" class="form-control"
                                value="{{ isset($eventService) ? $eventService->number_of_guests : old('number_of_guests') }}"
                                required>
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
                                <option value="unavailable"
                                    {{ isset($eventService) && $eventService->status == 'unavailable' ? 'selected' : '' }}>
                                    Unavailable
                                </option>
                            </select>
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="form-group">
                            <label for="assigned_to">Assigned To</label>
                            <input type="text" name="assigned_to" id="assigned_to" class="form-control"
                                value="{{ isset($eventService) ? $eventService->assigned_to : old('assigned_to') }}">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="location">Barangay</label>
                            <select name="location" id="location" class="form-control">
                                <option value="">Select a Barangay</option> <!-- Default option -->
                            </select>
                        </div>
                    </div>

                    <script>
                        // Static list of Barangays in Buguey, Cagayan
                        const barangays = [
                            "Ballang", "Balza", "Cabaritan", "Calamegatan", "Centro (Poblacion)", "Centro West",
                            "Dalaya", "Fula", "Leron", "M. Antiporda", "Maddalero", "Mala Este", "Mala Weste",
                            "Minanga Este", "Paddaya Este", "Pattao", "Quinawegan", "Remebella", "San Isidro",
                            "Santa Isabel", "Santa Maria", "Tabbac", "Villa Cielo", "Alucao Weste (San Lorenzo)",
                            "Minanga Weste", "Paddaya Weste", "San Juan", "San Vicente", "Villa Gracia", "Villa Leonora"
                        ];

                        // Function to populate the dropdown with Barangays
                        function populateBarangays() {
                            const locationDropdown = document.getElementById('location');

                            barangays.forEach(function(barangay) {
                                const option = document.createElement('option');
                                option.value = barangay; // Use the barangay name as the value
                                option.textContent = barangay; // Use the barangay name as the display text
                                locationDropdown.appendChild(option);
                            });
                        }

                        // Call the function to populate the dropdown on page load
                        document.addEventListener('DOMContentLoaded', populateBarangays);
                    </script>

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
                    <input type="file" name="image[]" class="form-control" id="formFileMultiple" multiple>
                </div>

                <button type="submit" class="btn btn-primary">{{ isset($eventService) ? 'Update' : 'Create' }} Event
                    Service</button>
            </form>
        </div>

    </div>

</x-serv-provider-layout>
