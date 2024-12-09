<?php

namespace App\Livewire;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public $messages = [];
    public $message; // For new message input
    public $receiverId; // The user you're chatting with
    public $receiverName; // The name of the receiver

    public function mount($receiverId)
    {
        $this->receiverId = $receiverId;

        // Fetch the receiver's name
        $this->receiverName = \App\Models\User::find($receiverId)->name ?? 'Unknown';

        $this->fetchMessages();
    }

    public function fetchMessages()
    {
        $this->messages = Message::where(function ($query) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $this->receiverId);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiverId)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get()->toArray();
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->receiverId,
            'message' => $this->message,
        ]);

        $this->message = ''; // Clear the input
        $this->fetchMessages(); // Refresh messages
    }

    public function render()
    {
        $role = auth()->user()->usertype; // Assume 'role' is a field on the User model

        switch ($role) {
            case 'user':
                $layout = 'layouts.client-layout';
                break;
            case 'service_provider':
                $layout = 'layouts.serv-provider-layout';
                break;
            default:
                $layout = 'layouts.app';
        }

        return view('livewire.chat')->layout($layout);
    }
}
