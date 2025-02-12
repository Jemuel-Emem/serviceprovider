<?php

namespace App\Livewire\Client;

use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User; // Assuming service providers are User models
use Livewire\Component;

class Chat extends Component
{
    public $messages = [];
    public $newMessage;
    public $user;
    public $selectedServiceProvider;
    public $serviceProviders = []; // Store the list of service providers

    public function mount()
    {
        $this->user = Auth::user();
        $this->serviceProviders = User::where('role', 2)->get(); // Fetch service providers with role 2
    }

    public function selectServiceProvider($providerId)
    {
        $this->selectedServiceProvider = $providerId;
        $this->loadMessages(); // Load messages for the selected provider
    }

    // public function loadMessages()
    // {
    //     if (!$this->selectedServiceProvider) {
    //         session()->flash('message', 'Please select a service provider.');
    //         return;
    //     }

    //     $this->messages = Message::with('client', 'serviceProvider')
    //         ->where(function ($query) {
    //             $query->where('client_id', $this->user->id)
    //                   ->where('serviceprovider_id', $this->selectedServiceProvider);
    //         })
    //         ->orWhere(function ($query) {
    //             $query->where('serviceprovider_id', $this->user->id)
    //                   ->where('client_id', $this->selectedServiceProvider);
    //         })
    //         ->get();
    // }

    public function loadMessages()
{
    if (!$this->selectedServiceProvider) {
        session()->flash('message', 'Please select a service provider.');
        return;
    }

    $this->messages = Message::with('client', 'serviceProvider')
        ->where(function ($query) {
            $query->where('client_id', $this->user->id)
                  ->where('serviceprovider_id', $this->selectedServiceProvider);
        })
        ->orWhere(function ($query) {
            $query->where('serviceprovider_id', $this->user->id)
                  ->where('client_id', $this->selectedServiceProvider);
        })
        ->get();

    // Mark all messages as read
    Message::where('serviceprovider_id', $this->user->id)
        ->where('client_id', $this->selectedServiceProvider)
        ->update(['is_read' => true]);
}

public function getUnreadMessagesCount($providerId)
{
    return Message::where('client_id', $this->user->id)
        ->where('serviceprovider_id', $providerId)
        ->where('is_read', false)
        ->count();
}


    public function sendMessage()
    {
        if (!$this->selectedServiceProvider) {
            session()->flash('message', 'Please select a service provider.');
            return;
        }

        Message::create([
            'client_id' => auth()->id(),
            'serviceprovider_id' => $this->selectedServiceProvider,
            'message' => $this->newMessage,
            'from_client' => true,
        ]);

        $this->newMessage = '';
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.client.chat');
    }
}
