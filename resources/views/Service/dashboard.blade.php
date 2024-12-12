<x-serv-provider-layout>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h5 class="h5 mb-0 text-black">Dashboard</h5>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <hr class="mt-0">

        {{-- Put the code here --}}

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Service provider Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}

                            <br>
                            total services count: {{ $ServicesCount }}
                            <br>
                            total bookings count: {{ $BookingsCount }}
                            <br>
                            total confirmed bookings count: {{ $ConfirmedBookingsCount }}
                            <br>
                            total pending bookings count: {{ $PendingBookingsCount }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-serv-provider-layout>
