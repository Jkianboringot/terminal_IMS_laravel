<?php

namespace App\Livewire\Admin\Suppliers;

use App\Models\Supplier;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.suppliers.index',[
    'suppliers'=>Supplier::all()]);
    }
}
