<?php

namespace App\Livewire\Client;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class App extends Component
{
    use WithPagination;

    public function render()
    {

        $clientId = auth()->id();


        $appointments = Appointment::where('user_id', $clientId)->paginate(10);

        return view('livewire.client.app', [
            'appointments' => $appointments
        ]);
    }
}
