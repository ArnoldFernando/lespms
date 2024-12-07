<x-serv-provider-layout>
    <div class="container">
        <h1>Booked Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookedUsers as $booking)
                    <tr>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->user->email }}</td>
                        <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if ($booking->user->is_blocked)
                                <span class="text-danger">Blocked</span>
                            @else
                                <span class="text-success">Active</span>
                            @endif
                        </td>
                        <td>
                            @if ($booking->user->is_blocked)
                                <form action="{{ route('service.user.unblock', $booking->user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Unblock
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">No Action</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No users have booked your services yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-serv-provider-layout>
