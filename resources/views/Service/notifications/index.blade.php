<x-serv-provider-layout>
    @if ($notifications->isEmpty())
        <p>No notifications available.</p>
    @else
        <ul>
            @foreach ($notifications as $notification)
                <li @if (!$notification->read) style="background-color: red;" @endif>{{ $notification->message }}
                </li>

                <a href="{{ route('notifications.show', $notification->id) }}">Read</a>
            @endforeach
        </ul>
    @endif

</x-serv-provider-layout>
