<?php

namespace App\Livewire\Admin\Sales;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Traits\WithCancel;
use Livewire\Component;

class Edit extends Component
{
    use WithCancel;

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



    function mount($id)
    {
        $this->sale = Sale::find($id);
        foreach ($this->sale->products as $key => $product) {

            array_push(
                $this->productList,
                [
                    'product_id' => $product->id,
                    'quantity' => $product->pivot->quantity,
                    'price' => $product->pivot->unit_price
                ]
            );

        }
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





    
   function selectProduct($id)
{
    $this->selectedProductId = $id;

    $product = Product::find($id);

    if ($product) {
        $this->productSearch = $product->name;
        $this->price = $product->purchase_price; 
    }
}

function addToList()
{
    try {
        // Manual validation to prevent deep state sync
        if (!$this->selectedProductId || !$this->quantity || !$this->price) {
            throw new \Exception("All fields are required.");
        }

        $product = Product::find($this->selectedProductId);
        if (!$product) {
            throw new \Exception("Selected product not found.");
        }

        if ($product->inventory_balance < $this->quantity) {
            throw new \Exception("Inventory balance for {$product->name} is too low.");
        }

        // Try to merge with existing entry
        foreach ($this->productList as $key => $item) {
            if ($item['product_id'] == $this->selectedProductId && $item['price'] == $this->price) {
                $this->productList[$key]['quantity'] += $this->quantity;

                $this->reset([
                    'selectedProductId',
                    'productSearch',
                    'quantity',
                    'price',
                ]);
                return;
            }
        }

        // Add new entry
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
        $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
    }
}



  function save()
{
    try {
        // Manual lightweight validation
        if (!$this->sale->sale_date ) {
            throw new \Exception("Sale date  are required.");
        }

        // Validate inventory for all items
        foreach ($this->productList as $item) {
            $product = Product::find($item['product_id']);

            if (!$product) {
                throw new \Exception("Product not found.");
            }

            if ($product->inventory_balance < $item['quantity']) {
                throw new \Exception("Not enough inventory for {$product->name}.");
            }
        }

        $this->sale->update();

        $this->sale->products()->detach();

        foreach ($this->productList as $item) {
            $this->sale->products()->attach($item['product_id'], [
                'quantity' => $item['quantity'],
                'unit_price' => $item['price']
            ]);
        }

        // Optional cleanup: if empty, delete sale
        if ($this->sale->products()->count() == 0) {
            $this->sale->delete();
        }

        return redirect()->route('admin.sales.index');
    } catch (\Throwable $th) {
        $this->dispatch('done', error: "Error: " . $th->getMessage());
    }
}

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->productSearch . '%')->get();

        return view(
            'livewire.admin.sales.edit',
            [
                'products' => $products,

            ]
        );
    }

}
