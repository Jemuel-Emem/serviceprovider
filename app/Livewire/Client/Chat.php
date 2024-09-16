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
        $this->loadMessages(); // Reload messages after sending
    }

    public function render()
    {
        return view('livewire.client.chat');
    }
}
