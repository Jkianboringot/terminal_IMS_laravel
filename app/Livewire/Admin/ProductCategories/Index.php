<?php

namespace App\Livewire\Admin\ProductCategories;

use App\Models\ProductCategory;
use Livewire\Component;

class Index extends Component
{
       function delete($id)
    {
        try {
            $category = ProductCategory::findOrFail($id);
            if (count($category->products) >0 ) {
                throw new \Exception("Permission : This Categories has {$category->products->count()} Categories ", 1);
            }

       
            $category->delete();

            $this->dispatch('done', success: "Successfully Deleted this user");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
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