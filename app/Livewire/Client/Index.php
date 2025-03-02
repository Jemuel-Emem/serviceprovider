<?php

namespace App\Livewire\Client;

use App\Models\Services;
use Livewire\Component;

class Index extends Component
{
    public $search = ''; // Property to hold the search query
    public $services = []; // Property to hold search results

    public function render()
    {
        return view('livewire.client.index');
    }

    public function updatedSearch()
    {

        if (!empty($this->search)) {
            $this->services = Services::where('service_name', 'like', '%' . $this->search . '%')

                ->get();
        } else {
            $this->services = [];
        }
    }

    public function searchServices()
    {
        $this->updatedSearch();
    }
}
