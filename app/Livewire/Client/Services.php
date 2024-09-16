<?php

namespace App\Livewire\Client;
use App\Models\appointment;
use App\Models\Services as ServiceOffer;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Livewire\Component;

class Services extends Component
{
    use Actions;
    use WithFileUploads;
    public $search = '';

    public $selectedService = null;
    public $showModal = false;
    public $payment_method = null;
    public $appointment_date = null;
    public $receipt = null;
    public $user_name;
    public $user_address;
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
            'user_name' => 'required|string|max:255',
            'user_address' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'payment_method' => 'required|string',
            'receipt' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $receiptPath = $this->receipt ? $this->receipt->store('gcash_receipts', 'public') : null;

        Appointment::create([
            'user_id' => auth()->id(),
            'serviceprovider_id' => $this->selectedService->user_id,
            'servicename' => $this->selectedService->service_name,
            'price' => $this->selectedService->price,
            'dateofappointment' => $this->appointment_date,
            'mop' => $this->payment_method,
            'gcashreceipt' => $receiptPath,
            'clientname'=> $this->user_name,
            'address'=> $this->user_address,
        ]);
        $this->notification()->success('Appointment', 'Appointment booked successfully!');
        $this->closeModal();
    }
    public function closeModal()
    {
        $this->showModal = false;
    }
}
