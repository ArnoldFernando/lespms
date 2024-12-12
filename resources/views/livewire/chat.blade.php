<div wire:poll="fetchMessages">
    <!-- Chat Container -->
    <div class="chat-container border rounded shadow mx-auto"
        style="max-width: 100%; height: 87vh; display: flex; flex-direction: column; overflow-x: hidden; overflow-y: auto;">
        <!-- Chat Header -->
        <div class="chat-header bg-primary text-white p-1 d-flex justify-content-between align-items-center">
            <h3 class="m-0"><i class="fa-solid fa-comment-dots me-1 fs-4 "></i>Chat with {{ $receiverName }}</h3>
            <a href="{{ route(auth()->user()->usertype == 'service_provider' ? 'event-services.bookings' : 'client.service.index') }}"
                class="btn btn-light">Close</a>
        </div>

        <!-- Messages Section -->
        <div id="messages-container" class="p-3 bg-light overflow-auto flex-grow-1">
            @foreach ($messages as $msg)
                <div
                    class="d-flex {{ $msg['sender_id'] == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                    <div
                        class="p-2 mb-2 rounded {{ $msg['sender_id'] == auth()->id() ? 'bg-primary text-white' : 'bg-secondary text-white' }}">
                        {{ $msg['message'] }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Message Input -->
        <div class="p-3 bg-secondary bg-opacity-25 border-top">
            <form wire:submit.prevent="sendMessage" class="d-flex">
                <input type="text" wire:model="message" placeholder="Type a message..." class="form-control me-1"
                    autofocus>
                <button type="submit" class="btn btn-primary d-flex align-items-center">
                    Send <i class="fa-solid fa-paper-plane ms-2"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.hook('message.processed', () => {
                const container = document.getElementById('messages-container');
                container.scrollTop = container.scrollHeight; // Auto-scroll to the bottom
            });
        });
    </script>
</div>
