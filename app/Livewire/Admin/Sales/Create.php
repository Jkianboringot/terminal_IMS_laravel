<?php

namespace App\Livewire\Admin\Sales;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Traits\ProductSearch;
use App\Traits\WithCancel;
use Livewire\Component;

class Create extends Component
{

     use ProductSearch;

     use WithCancel;
     public $overrideLowStock = false;
    public $customerSearch;

    public $productSearch;

    public $selectedProductId;

    public $quantity;
    public $price;

public $pendingAction = null; 

    public Sale $sale;
    public $productList = [];


    function rules()
    {
        return [
            'sale.customer_id' => 'required',
            'sale.sale_date' => 'required',
        ];
    }



    function mount()
    {
        $this->sale = new Sale();
     
    $this->sale->sale_date = now()->toDateString();
    }

    function selectCustomer($id)
    {
        $this->sale->customer_id = $id;
        $this->customerSearch=$this->sale->customer->name;

    }
function addQuantity($key)
{
    $product = Product::find($this->productList[$key]['product_id']);
    $newQty  = $this->productList[$key]['quantity'] + 1;

    if ($product->inventory_balance < $newQty) {
        session()->flash('warning', "Not enough stock for {$product->name}. Available: {$product->inventory_balance}.");
        return;
    }

    if (($product->inventory_balance - $newQty) < 10 && !$this->overrideLowStock) {
        session()->flash('warning', "Adding this will bring {$product->name} below 10 in stock.");
        $this->pendingAction = ['type' => 'addQuantity', 'key' => $key]; // store pending action
        return;
    }

    $this->productList[$key]['quantity']++;
    $this->overrideLowStock = false; 
    $this->pendingAction = null;
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
        $this->price = $product->sale_price; 
    }
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

        $product = Product::find($this->selectedProductId);

        if (!$product) {
            $this->dispatch('done', error: "Warning: Product not found.");
            return;
        }

        // 🚨 Hard stop if requested qty is more than available
        if ($product->inventory_balance < $this->quantity) {
            $this->dispatch('done', error: "Warning: Inventory balance for {$product->name} is too low.");
            return;
        }

       // ⚠️ Soft warning if stock would fall below 10
if (($product->inventory_balance - $this->quantity) < 10 && !$this->overrideLowStock) {
    session()->flash('warning', "Adding this will bring {$product->name} below 10 in stock.");
    $this->pendingAction = ['type' => 'addToList']; // <---- ADD THIS
    return;
}


        // Merge if same product & price already exists
        foreach ($this->productList as $key => $listItem) {
            if ($listItem['product_id'] == $this->selectedProductId && $listItem['price'] == $this->price) {
                $this->productList[$key]['quantity'] += $this->quantity;
                $this->overrideLowStock = false; // reset override
                return;
            }
        }

        // Otherwise add as new item
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

        $this->overrideLowStock = false; // reset after adding
    } catch (\Throwable $th) {
        $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
    }
}

public function continueAnyway()
{
    $this->overrideLowStock = true;

    if ($this->pendingAction) {
        if ($this->pendingAction['type'] === 'addToList') {
            $this->addToList();
        } elseif ($this->pendingAction['type'] === 'addQuantity') {
            $this->addQuantity($this->pendingAction['key']);
        }
    }

    $this->pendingAction = null;
 
}



    function save()
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
   
        $customers = Customer::where('name', 'like', '%' . $this->customerSearch . '%')->get();

        return view(
            'livewire.admin.sales.create',
            [
                'products' => $this->productSearch(),

                'customers' => $customers,

            ]
        );
    }
}
