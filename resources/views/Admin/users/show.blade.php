<x-app-layout>
    <pre>{{ json_encode($user, JSON_PRETTY_PRINT) }}</pre>
    <a href="{{ route('admin.users.index') }}">Back</a>
</x-app-layout>
