<x-app-layout>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>is_blocked</th>
                <th>blocked_by</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->usertype }}</td>
                    <td>{{ $user->is_blocked }}</td>
                    <td>{{ $user->blocked_by }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}">View</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</x-app-layout>
