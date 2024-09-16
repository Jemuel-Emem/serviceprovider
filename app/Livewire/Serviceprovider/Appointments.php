<?php

namespace App\Livewire\Serviceprovider;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class Appointments extends Component
{
    use WithPagination;

    public $search = '';
    public $showDeclineModal = false;
    public $declineMessage = '';
    public $appointmentIdToDecline;

    public function render()
    {
        $serviceProviderId = auth()->id();

        $appointments = Appointment::where('serviceprovider_id', $serviceProviderId)
            ->when($this->search, function ($query) {
                $query->where('servicename', 'like', "%{$this->search}%")
                    ->orWhere('status', 'like', "%{$this->search}%");
            })
            ->paginate(10);

        return view('livewire.serviceprovider.appointments', [
            'appointments' => $appointments,
        ]);
    }

    public function approveAppointment($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        $appointment->status = 'completed';
        $appointment->save();
    }


    public function declineAppointment($appointmentId)
    {

        $appointment = Appointment::find($appointmentId);
        $appointment->status = 'canceled';
        $appointment->save();
    }

    public function closeDeclineModal()
    {
        $this->showDeclineModal = false;
        $this->declineMessage = '';  // Reset the message
    }
}
