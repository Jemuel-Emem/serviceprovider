<?php

namespace App\Livewire\Client;

use App\Models\Services as ServiceOffer;
use Livewire\Component;

class Services extends Component
{
    public $search = '';
    public $selectedService = null;
    public $showModal = false;
    public $payment_method = null;

    public function render()
    {
        $services = ServiceOffer::query()
            ->when($this->search, function ($query) {
                $query->where('service_name', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            })
            ->paginate(10);

        return view('livewire.client.services', compact('services'));
    }

    public function viewService($serviceId)
    {
        $this->selectedService = ServiceOffer::find($serviceId);
        $this->showModal = true;
    }

    public function appointNow()
    {
        $this->validate([

            'payment_method' => 'required|in:walk_in,gcash', // Validate payment method
        ]);

        // Handle appointment logic here
        // For example, save appointment details or redirect to another page
        // You can also display a confirmation message

        $this->closeModal();
    }
    public function closeModal()
    {
        $this->showModal = false;
    }
}
