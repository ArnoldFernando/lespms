<x-app-layout>
    <div class="container my-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
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
                            <td>
                                <a href="{{ route('admin.users.show', $user->id) }}"
                                    class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
