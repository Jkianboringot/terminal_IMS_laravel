<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{

           function delete($id)
    {
        try {
            $product = Product::findOrFail($id);
            if (count($product->purchases) >0 || count($product->sales) >0 ) {
                throw new \Exception("Permission : This Categories has been bought  and/or sold {$product->purchases->count()} Purchase {$product->sales->count()}  Sales", 1);
            }

       
            $product->delete();

            $this->dispatch('done', success: "Successfully Deleted this user");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.products.index',[
    'products'=>Product::all()]);
    }
}
