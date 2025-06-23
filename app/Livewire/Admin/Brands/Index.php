<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.brands.index',[
            'brands'=>Brand::all()
        ]);
    }
}
