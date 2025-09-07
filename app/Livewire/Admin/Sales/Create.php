<?php

namespace App\Livewire\Admin\Sales;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;

class Create extends Component
{

    public $productSearch;

    public $selectedProductId;

    public $quantity;
    public $price;


    public Sale $sale;
    public $productList = [];


    function rules()
    {
        return [
            'sale.sale_date' => 'required',
        ];
    }



    function mount()
    {
        $this->sale = new Sale();
     
    $this->sale->sale_date = now()->toDateString();
    }


    function addQuantity($key)
    {
        $this->productList[$key]['quantity']++;
    }
    function subtractQuantity($key)
    {
        if ($this->productList[$key]['quantity'] > 1) {
            $this->productList[$key]['quantity']--;
        }


    }

    function deleteCartItem($key)
    {
        array_splice($this->productList, $key, 1);
    }



   function selectProduct($id)
{
    $this->selectedProductId = $id;

    $product = Product::find($id);

    if ($product) {
        $this->productSearch = $product->name;
        $this->price = $product->purchase_price; 
    }
}
    public function cancelEdit()
{
    $this->reset(); // or reset specific fields
    $this->dispatch('notify', 'Create canceled'); // or show feedback
}


    function addToList()
    {
        try {
            $this->validate([
                'selectedProductId' => 'required',
                'quantity' => 'required',
            ]);

            if (empty($this->sale->sale_date)) {
            $this->sale->sale_date = now()->toDateString();
        }

            if (
                Product::find($this->selectedProductId)->inventory_balance < $this->quantity
            ) {
                throw new \Exception("Inventory Balance is Low", 1);

            }
            foreach ($this->productList as $key => $listItem) {

                if ($listItem['product_id'] == $this->selectedProductId && $listItem['price'] == $this->price) {
                    $this->productList[$key]['quantity'] += $this->quantity;
                    return;
                    # code...
                }
            }


            array_push($this->productList, [
                'product_id' => $this->selectedProductId,
                'quantity' => $this->quantity,
                'price' => $this->price
            ]);

            $this->reset([
                'selectedProductId',
                'productSearch',
                'quantity',
                'price',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    function makeSale()
    {

        try {
            $this->validate();
            foreach ($this->productList as $key => $listItem) {

                if (
                    Product::find($listItem['product_id'])->inventory_balance < $listItem['quantity']
                ) {
                    throw new \Exception("Inventory Balance for" . Product::find($listItem['product_id'])->name . "is Low", 1);
                }

            }
            $this->sale->save();
            foreach ($this->productList as $key => $listItem) {

                $this->sale->products()->attach($listItem['product_id'], [
                    'quantity' => $listItem['quantity'],
                    'unit_price' => $listItem['price']
                ]);
            }


            if ($this->sale->products->count() == 0) {
                $this->sale->delete();
            }
            return redirect()->route('admin.sales.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }

    }   

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->productSearch . '%')->get();

        return view(
            'livewire.admin.sales.create',
            [
                'products' => $products,

            ]
        );
    }
}
