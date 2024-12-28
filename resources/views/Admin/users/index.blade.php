<x-app-layout>
    {{-- Data Table --}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/jquery-3.7.1.js">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/js/dataTables.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js">

    <div class="content_header">
        <h5 class="" style="font-weight:600;"> <i class="fa-solid fa-caret-right text-primary"
                style="margin-right: 5px"></i>Users List</h5>
        <hr class="mt-0">
    </div>

    {{-- Content --}}
    <div class="container-fluid">
        <div class="table-responsive bg-white p-2 shadow-sm">
            <table class="table table-striped table-bordered" id="myTable">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">User Type</th>
                        <th scope="col">Is Blocked</th>
                        <th scope="col">Blocked By</th>
                        <th scope="col">Verified</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @if ($user->id == Auth::id())
                            @continue
                        @endif
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->usertype }}</td>
                            <td>{{ $user->is_blocked ? 'Yes' : 'No' }}</td>
                            <td>{{ $user->blocked_by ?? 'N/A' }}</td>
                            <td class="{{ $user->verified ? 'text-success' : 'text-danger' }}">
                                {{ $user->verified ? 'Yes' : 'No' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.users.show', $user->id) }}"
                                    class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

    <script>
        new DataTable('#myTable', {
            layout: {
                topStart: {
                    pageLength: {
                        menu: [10, 25, 50, 100] // Page length options
                    }
                },
                topEnd: {
                    search: {
                        placeholder: 'Type search here' // Custom search placeholder
                    }
                },
                bottomEnd: {
                    paging: {
                        buttons: 3 // Number of pagination buttons
                    }
                }
            },
            language: {
                lengthMenu: " _MENU_ Records per page",
                info: "Showing _START_ to _END_ of _TOTAL_ records",
                infoEmpty: "No records available",
                infoFiltered: "(filtered from _MAX_ total records)",
                search: "Search:",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                },
                emptyTable: "No data available in the table" // Customize empty message
            },
            columnDefs: [{
                    orderable: false,
                    targets: [4, 5, 6]
                } // Disable sorting for specific columns
            ],
        });
    </script>
</x-app-layout>
