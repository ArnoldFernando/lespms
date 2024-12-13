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

        @if (session('updated-success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('updated-success') }}',
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
            <h5 class="h5 mb-0 text-black">My Services</h5>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <hr class="mt-0">

        <div class="container-fluid">
            <!-- Put your code here -->

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
                                    <a href="{{ route('service-provider.services.show', $service->id) }}"
                                        class="btn btn-info">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

</x-serv-provider-layout>
