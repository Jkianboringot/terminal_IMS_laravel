<?php

namespace App\Livewire\Admin\Banks;

use App\Models\Bank;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.banks.index',[
    'banks'=>Bank::all()]
        );
    }
}
