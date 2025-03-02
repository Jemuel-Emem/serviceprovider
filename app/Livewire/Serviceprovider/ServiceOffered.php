<?php

namespace App\Livewire\Serviceprovider;

use App\Models\services as Service;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithFileUploads;

class ServiceOffered extends Component
{
    use Actions;
    use WithFileUploads;

    public $photo;
    public $service_name;
    public $phone_number;
    public $address;
    public $description;
    public $price;
    public $status;
    public $serviceId;

    protected $rules = [
        'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'service_name' => 'required|string|max:255',
        'phone_number' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
    ];

    public function addService()
    {
        $this->validate();

        $photoPath = $this->photo ? $this->photo->store('photos', 'public') : null;

        Service::create([
            'user_id' => auth()->id(),
            'service_name' => $this->service_name,
           // 'phone_number' => $this->phone_number,
           'status' => $this->status,
            'description' => $this->description,
            'price' => $this->price,
            'photo_path' => $photoPath,
            'gcashnumber' => auth()->user()->gcashnumber,
            'gcashname' => auth()->user()->gcashname,
        ]);

        $this->notification()->success('Service added', 'Service added successfully!');
        $this->reset();
    }

    public function editService($id)
    {
        $service = Service::findOrFail($id);
        $this->serviceId = $service->id;
        $this->service_name = $service->service_name;
        // $this->phone_number = $service->phone_number;
         $this->status = $service->status;
        $this->description = $service->description;
        $this->price = $service->price;
    }

    public function updateService()
    {
        $this->validate();

        $service = Service::findOrFail($this->serviceId);
        $photoPath = $this->photo ? $this->photo->store('photos', 'public') : $service->photo_path;

        $service->update([
            'service_name' => $this->service_name,
            // 'phone_number' => $this->phone_number,
            'status' => $this->status,
            'description' => $this->description,
            'price' => $this->price,
            'photo_path' => $photoPath,
        ]);

        $this->notification()->success('Service updated', 'Service updated successfully!');
        $this->reset();
    }

    public function deleteService($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        $this->notification()->success('Service deleted', 'Service deleted successfully!');
    }

    public function render()
    {
        $services = Service::where('user_id', auth()->id())->get();
        return view('livewire.serviceprovider.service-offered', compact('services'));
    }
}
