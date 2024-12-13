{{-- TODO: Style a sinlge notification view --}}
<x-client-layout>
    <div class="notification">

        @if ($notification)
            <div class="single-notification">
                <h2>{{ $notification->title }}</h2>
                <p>{{ $notification->message }}</p>
                <span>{{ $notification->created_at->format('M d, Y H:i') }}</span>
            </div>
        @endif

    </div>

</x-client-layout>
