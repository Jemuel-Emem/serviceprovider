<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class Appointments extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $appointments = Appointment::query()
            ->when($this->search, function($query) {
                $query->where('service_name', 'like', "%{$this->search}%")
                      ->orWhereHas('client', function($q) {
                          $q->where('name', 'like', "%{$this->search}%");
                      });
            })
            ->paginate(10);

        return view('livewire.admin.appointments', compact('appointments'));
    }
}
