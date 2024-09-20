<?php

namespace App\Livewire\Client;

use App\Models\Appointment;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithPagination;

class App extends Component
{
    use Actions;
    use WithPagination;

    public $showRateModal = false;
    public $selectedAppointment = null;
    public $rating, $comment;

    // Open the Rate Modal
    public function openRateModal($appointmentId)
    {
        $this->selectedAppointment = Appointment::find($appointmentId);
        if ($this->selectedAppointment) {
            $this->showRateModal = true;
        } else {
            $this->showRateModal = false;
            session()->flash('message', 'Appointment not found!');
        }
    }


    public function closeRateModal()
    {
        $this->showRateModal = false;
        $this->rating = '';
        $this->comment = '';
    }


    public function rateAppointment()
    {
        $this->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);


        if ($this->selectedAppointment) {
            $this->selectedAppointment->update([
                'rating' => $this->rating,
                'comment' => $this->comment,
            ]);
            $this->notification()->success('Appointment rated successfully!');

            $this->closeRateModal();
        }
    }


    public function render()
    {
        $clientId = auth()->id();


        $appointments = Appointment::where('user_id', $clientId)->paginate(10);

        return view('livewire.client.app', [
            'appointments' => $appointments,
        ]);
    }
}
