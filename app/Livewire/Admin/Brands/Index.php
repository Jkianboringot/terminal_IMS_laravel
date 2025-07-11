<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;

class Index extends Component
{
      function delete($id)
    {
        try {
            $brand = Brand::findOrFail($id);
            if (count($brand->products) >0 ) {
                throw new \Exception("Permission denied: This Brand has {$brand->products->count()} Product ", 1);
            }

       
            $brand->delete();

            $this->dispatch('done', success: "Successfully Deleted this user");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.brands.index',[
            'brands'=>Brand::all()
        ]);
    }
}
