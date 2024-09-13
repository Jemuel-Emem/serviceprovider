<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class ServiceProvider extends Component
{
    public function approve($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->serviceproviderstatus = 'approved';
            $user->save();
        }
    }

    public function decline($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->serviceproviderstatus = 'declined';
            $user->save();
        }
    }

    public function render()
    {
        $serviceProviders = User::where('role', 2)->get();
        return view('livewire.admin.service-provider', compact('serviceProviders'));
    }
}
