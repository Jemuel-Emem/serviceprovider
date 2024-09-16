<?php

namespace App\Livewire\Serviceprovider;

use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Chat extends Component
{
    public $selectedUser = null; // Ensure it's initialized to null
    public $messages = [];
    public $newMessage;
    public $users = [];

    public function mount()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $this->users = User::whereHas('sentMessages', function ($query) {
            $query->where('serviceprovider_id', Auth::id());
        })->get();
    }

    public function selectUser($userId)
    {
        $this->selectedUser = $userId;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        if (!$this->selectedUser) {
            return;
        }

        $this->messages = Message::where(function ($query) {
            $query->where('client_id', $this->selectedUser)
                  ->where('serviceprovider_id', Auth::id());
        })
        ->orWhere(function ($query) {
            $query->where('serviceprovider_id', $this->selectedUser)
                  ->where('client_id', Auth::id());
        })
        ->get();
    }

    public function sendMessage()
    {
        if (!$this->selectedUser) {
            session()->flash('message', 'Please select a user.');
            return;
        }

        Message::create([
            'client_id' => Auth::id(),
            'serviceprovider_id' => $this->selectedUser,
            'message' => $this->newMessage,
            'from_client' => false, // Assuming service provider sends messages as `false`
        ]);

        $this->newMessage = '';
        $this->loadMessages(); // Reload messages after sending
    }

    public function render()
    {
        return view('livewire.serviceprovider.chat');
    }
}
