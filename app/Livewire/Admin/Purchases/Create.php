<?php

namespace App\Livewire\Admin\Purchases;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Livewire\Component;

class Create extends Component
{
    public $supplierSearch;
    public $productSearch;
    public $selectedSupplierId;
    public $selectedProductId;

    public $quantity;
    public $price;


    public Purchase $purchase;
    public $productList = [];




    function mount()
    {
        $this->purchase = new Purchase();
    }

    function deleteCartItem($key){
        array_splice($this->productList,$key,1);
    }
    function addToList()
    {
        try {
            $this->validate([
                'selectedProductId' => 'required',
                'quantity' => 'required',
                'price' => 'required',
            ]);

            foreach ($this->productList as $key => $listItem) {
                if ($listItem['product_id']==$this->selectedProductId && $listItem['price']==$this->price) {
                    $this->productList[$key]['quantity']+=$this->quantity;
                return;
                    # code...
                }
            }


            array_push($this->productList, [
                'product_id' => $this->selectedProductId,
                'quantity' => $this->quantity,
                'price' => $this->price
            ]);
        } catch (\Throwable $th) {
             $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    function selectSupplier($id)
    {
        $this->selectedSupplierId = $id;
    }

    function selectProduct($id)
    {
        $this->selectedProductId = $id;
    }


    // function save()
    // {
    //     try {
    //         $this->validate();

    //         $this->purchase->save();

    //         return redirect()->route('admin.purchases.index');
    //     } catch (\Throwable $th) {
    //         $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
    //     }
    // }
    public function render()
    {
        $suppliers = Supplier::where('name', 'like', '%' . $this->supplierSearch . '%')->get();
        $products = Product::where('name', 'like', '%' . $this->productSearch . '%')->get();

        return view(
            'livewire.admin.purchases.create',
            [
                'suppliers' => $suppliers,
                'products' => $products,

            ]
        );
    }
}
