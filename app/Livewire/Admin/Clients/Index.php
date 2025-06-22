<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.clients.index',[
            'clients'=>Client::all()
        ]);
    }
}
