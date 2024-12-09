<div wire:poll="fetchMessages">
    <!-- Your chat messages -->


    <div class="chat-container">
        <!-- Chat Header -->
        <div class="chat-header bg-blue-500 text-dark p-4">
            <h2>Chat with {{ $receiverName }}</h2>
        </div>

        <!-- Messages Section -->
        <div id="messages-container" class="p-4 bg-gray-900 h-96 overflow-y-scroll">
            @foreach ($messages as $msg)
                <div class="{{ $msg['sender_id'] == auth()->id() ? 'text-right' : 'text-left' }}">
                    <div
                        class="inline-block p-2 rounded-lg {{ $msg['sender_id'] == auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-300' }}">
                        {{ $msg['message'] }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Message Input -->
        <div class="p-4 bg-gray-200">
            <form wire:submit.prevent="sendMessage" class="flex">
                <input type="text" wire:model="message" placeholder="Type a message..."
                    class="flex-1 px-4 py-2 border rounded-l-lg">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-r-lg">Send</button>
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
