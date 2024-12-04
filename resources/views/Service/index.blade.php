<x-serv-provider-layout>
    <div class="container">
        @if ($services->isEmpty())
            <p>No services available.</p>
        @else
            <div class="row">
                @foreach ($services as $service)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                @if ($service && !empty($service->image) && is_array($service->image))
                                    <img src="{{ asset(str_replace('public/', 'storage/', $service->image[0])) }}"
                                        alt="Image" style="width: 100%; height: 150px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/img/default.png') }}" alt="Default Image"
                                        style="width: 100%; height: 150px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="card-body">
                                <p class="card-text"><strong>Description:</strong> {{ $service->title }}</p>
                                <p class="card-text"><strong>Location:</strong> {{ $service->location }}</p>
                            </div>
                            <div class="card-footer">
                                <!-- Button for editing or viewing -->
                                <a href="{{ route('services.show', $service->id) }}" class="btn btn-info">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-serv-provider-layout>
