<?php

namespace App\Livewire\Admin\Quotations;

use App\Models\Quotation;
use App\Models\Product;
use App\Models\Customer;
use Livewire\Component;

class Edit extends Component
{
    
    public $customerSearch;
    public $productSearch;

    public $selectedProductId;

    public $quantity;
    public $price;


    public Quotation $quotation;
    public $productList = [];


    function rules()
    {
        return [
            'quotation.quotation_date' => 'required',
            'quotation.customer_id' => 'required',
        ];
    }



    function mount($id)
    {
        $this->quotation = Quotation::find($id);
        foreach ($this->quotation->products as $key => $product) {

            array_push(
                $this->productList,
                [
                    'product_id' => $product->id,
                    'quantity' => $product->pivot->quantity,
                    'price' => $product->pivot->unit_price
                ]
            );

        }
        $this->customerSearch = $this->quotation->customer->name;
    }
    function deleteCartItem($key)
    {
        array_splice($this->productList, $key, 1);
    }

    function addQuantity($key)
    {
        $this->productList[$key]['quantity']++;
    }
   function subtractQuantity($key)
    {
            if ( $this->productList[$key]['quantity'] > 1) {
                 $this->productList[$key]['quantity']--;
            }
         
       
    }



    function selectCustomer($id)
    {
        $this->quotation->customer_id = $id;
        $this->customerSearch=$this->quotation->customer->name;

    }

    function selectProduct($id)
    {
        $this->selectedProductId = $id;
        $this->productSearch=Product::find($id)->name;

    }

    function addToList()
{
    try {
        if (!$this->selectedProductId || !$this->quantity || !$this->price) {
            throw new \Exception("Please fill all product fields (Product, Quantity, Price).");
        }

        foreach ($this->productList as $key => $listItem) {
            if ($listItem['product_id'] == $this->selectedProductId && $listItem['price'] == $this->price) {
                $this->productList[$key]['quantity'] += $this->quantity;
                return;
            }
        }

        $this->productList[] = [
            'product_id' => $this->selectedProductId,
            'quantity' => $this->quantity,
            'price' => $this->price
        ];

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
function makeQuotation()
{
    try {
        if (!$this->quotation->quotation_date || !$this->quotation->customer_id) {
            throw new \Exception("Quotation date and customer are required.");
        }

        $this->quotation->update();
        $this->quotation->products()->detach();

        foreach ($this->productList as $listItem) {
            $this->quotation->products()->attach($listItem['product_id'], [
                'quantity' => $listItem['quantity'],
                'unit_price' => $listItem['price']
            ]);
        }

        return redirect()->route('admin.quotations.index');
    } catch (\Throwable $th) {
        $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
    }
}

    public function render()
    {
        $customers = Customer::where('name', 'like', '%' . $this->customerSearch . '%')->get();
        $products = Product::where('name', 'like', '%' . $this->productSearch . '%')->get();

        return view(
            'livewire.admin.quotations.edit',
            [
                'customers' => $customers,
                'products' => $products,

            ]
        );
    }
   

}
