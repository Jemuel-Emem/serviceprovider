<?php

namespace App\Livewire\Client;
use App\Models\message;
use Livewire\Component;

class ClientServiceProviderChat extends Component
{ public $messages = [];
    public $newMessage = '';
    public $clientId;
    public $serviceProviderId;

    public function mount($clientId, $serviceProviderId)
    {
        $this->clientId = $clientId;
        $this->serviceProviderId = $serviceProviderId;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Message::where(function($query) {
            $query->where('client_id', $this->clientId)
                  ->where('serviceprovider_id', $this->serviceProviderId);
        })->orWhere(function($query) {
            $query->where('client_id', $this->serviceProviderId)
                  ->where('serviceprovider_id', $this->clientId);
        })->get();
    }

    public function sendMessage()
    {
        $this->validate([
            'newMessage' => 'required|string|max:255',
        ]);

        Message::create([
            'client_id' => $this->clientId,
            'serviceprovider_id' => $this->serviceProviderId,
            'message' => $this->newMessage,
            'from_client' => true, // or false depending on who is sending
        ]);

        $this->newMessage = '';
        $this->loadMessages();
    }


    public function render()
    {
        return view('livewire.client.client-service-provider-chat');
    }
}
