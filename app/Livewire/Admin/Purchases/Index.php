<?php

namespace App\Livewire\Admin\Purchases;

use App\Models\Purchase;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.purchases.index',[
    'purchases'=>Purchase::all()]);
    }
}
