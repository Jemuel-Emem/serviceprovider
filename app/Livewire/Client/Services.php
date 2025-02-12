<?php

namespace App\Livewire\Client;
use App\Models\appointment;
use App\Models\Services as ServiceOffer;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Livewire\Component;

class Services extends Component
{
    public $showCommentsModal = false;
    public $comments = [];

    use Actions;
    use WithFileUploads;
    public $search = '';
    public $showRateModal = false;
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
            ->with('user')
            ->when($this->search, function ($query) {
                $query->where('service_name', 'like', "%{$this->search}%")
                      ->orWhere('description', 'like', "%{$this->search}%");
            })
            ->paginate(10);

        return view('livewire.client.services', compact('services'));
    }

    public function searchh(){

    }
    public function viewComments($servicename)
    {

        $this->selectedService = ServiceOffer::where('service_name', $servicename)->first();


        $this->comments = Appointment::where('servicename', $servicename)->get(); // Assuming 'servicename' is a column in the comments table


        $this->showCommentsModal = true;
    }

    public function closeCommentsModal()
    {
        $this->showCommentsModal = false;
    }
    public function getServiceRating($serviceName)
    {

        return Appointment::where('servicename', $serviceName)
            ->whereNotNull('rating')
            ->avg('rating');
    }

    public function viewService($serviceId)
    {
        $this->selectedService = ServiceOffer::find($serviceId);
        $this->showModal = true;
    }

    public function appointNow()
    {

        $this->validate([


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
            'clientname' => auth()->user()->name,
            'phonenumber' => auth()->user()->phonenumber,
            'address'=> auth()->user()->address,
        ]);

        $this->notification()->success('Appointment', 'Appointment booked successfully!');
        $this->closeModal();
    }
    public function closeModal()
    {
        $this->showModal = false;
    }
}
