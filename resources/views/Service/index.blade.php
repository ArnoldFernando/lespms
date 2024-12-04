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
                                <h5 class="card-title">{{ $service->title }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><strong>Description:</strong> {{ $service->description }}</p>
                                <p class="card-text"><strong>Rate:</strong> ${{ $service->rate }}</p>
                                <p class="card-text"><strong>Status:</strong> {{ ucfirst($service->status) }}</p>
                                <p class="card-text"><strong>Assigned To:</strong> {{ $service->assigned_to }}</p>
                                <p class="card-text"><strong>Location:</strong> {{ $service->location }}</p>
                                <p class="card-text"><strong>Special Requests:</strong>
                                    {{ $service->special_requests }}</p>
                                <p class="card-text"><strong>Service Provider ID:</strong>
                                    {{ $service->service_provider_id }}</p>

                                @if ($service->scheduled_date)
                                    <p class="card-text"><strong>Scheduled Date:</strong>
                                        {{ $service->scheduled_date->format('Y-m-d') }}</p>
                                @else
                                    <p class="card-text"><strong>Scheduled Date:</strong> Not scheduled</p>
                                @endif

                                @if ($service->available_until)
                                    <p class="card-text"><strong>Available Until:</strong>
                                        {{ $service->available_until->format('Y-m-d') }}</p>
                                @else
                                    <p class="card-text"><strong>Available Until:</strong> N/A</p>
                                @endif
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
