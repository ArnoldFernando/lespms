<x-app-layout>
    <pre>{{ json_encode($user, JSON_PRETTY_PRINT) }}</pre>
    <a href="{{ route('users.edit', $user->id) }}">Edit</a>
    <a href="{{ route('users.index') }}">Back</a>
</x-app-layout>
