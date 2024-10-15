<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Services;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $approvedProviders = User::where('role', 2)
                                ->where('serviceproviderstatus', 'approved')
                                ->count();

        $totalServices = Services::count();

        $totalAppointments = Appointment::count();

        return view('livewire.admin.index', [
            'approvedProviders' => $approvedProviders,
            'totalServices' => $totalServices,
            'totalAppointments' => $totalAppointments,
        ]);
    }
}
