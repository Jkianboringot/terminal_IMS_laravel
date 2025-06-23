<?php

namespace App\Livewire\Admin\ProductCategories;

use App\Models\ProductCategory;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.product-categories.index',[
            'productCategories'=>ProductCategory::all()
        ]
    );
    }
}
// 'productCategories' refers to the foreach in index.blade it prettry much the variable for evrything in prodoctCategory
// or variable for te frontend