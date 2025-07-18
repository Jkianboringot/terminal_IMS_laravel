<?php

namespace App\Livewire\Admin\Purchases;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Livewire\Component;

class Edit extends Component
{
    public $supplierSearch;
    public $productSearch;

    public $selectedProductId;

    public $quantity;
    public $price;


    public Purchase $purchase;
    public $productList = [];


    function rules()
    {
        return [
            'purchase.purchase_date' => 'required',
            'purchase.supplier_id' => 'required',
        ];
    }



    function mount($id)
    {
        $this->purchase = Purchase::find($id);
        foreach ($this->purchase->products as $key => $product) {

            array_push(
                $this->productList,
                [
                    'product_id' => $product->id,
                    'quantity' => $product->pivot->quantity,
                    'price' => $product->pivot->unit_price
                ]
            );

        }
        $this->supplierSearch = $this->purchase->supplier->name;
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



    function selectSupplier($id)
    {
        $this->purchase->supplier_id = $id;
               $this->supplierSearch = $this->purchase->supplier->name;
        

    }

    function selectProduct($id)
    {
        $this->selectedProductId = $id;
        $this->productSearch=Product::find($id)->name;

    }
function addToList()
{
    try {
        // Manual checks to replace validate()
        if (!$this->selectedProductId || !$this->quantity || !$this->price) {
            throw new \Exception('All product fields are required.');
        }

        // Try to merge with an existing entry (same product and price)
        foreach ($this->productList as $key => $item) {
            if ($item['product_id'] == $this->selectedProductId && $item['price'] == $this->price) {
                $this->productList[$key]['quantity'] += $this->quantity;
                $this->reset(['selectedProductId', 'productSearch', 'quantity', 'price']);
                return;
            }
        }

        // Add new item to list
        $this->productList[] = [
            'product_id' => $this->selectedProductId,
            'quantity' => $this->quantity,
            'price' => $this->price
        ];

        // Clean up input fields
        $this->reset(['selectedProductId', 'productSearch', 'quantity', 'price']);
    } catch (\Throwable $th) {
        $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
    }
}

   function makePurchase()
{
    try {
        // Manual checks instead of $this->validate()
        if (!$this->purchase->purchase_date || !$this->purchase->supplier_id) {
            throw new \Exception('Purchase Date and Supplier are required.');
        }

        if (empty($this->productList)) {
            throw new \Exception('You must add at least one product to the list.');
        }

        // Save the updated purchase info
        $this->purchase->save();

        // Detach old products
        $this->purchase->products()->detach();

        // Re-attach updated products from productList
        foreach ($this->productList as $listItem) {
            $this->purchase->products()->attach($listItem['product_id'], [
                'quantity' => $listItem['quantity'],
                'unit_price' => $listItem['price']
            ]);
        }

        // Redirect to index after successful update
        return redirect()->route('admin.purchases.index');

    } catch (\Throwable $th) {
        $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
    }
}
    public function render()
    {
        $suppliers = Supplier::where('name', 'like', '%' . $this->supplierSearch . '%')->get();
        $products = Product::where('name', 'like', '%' . $this->productSearch . '%')->get();

        return view(
            'livewire.admin.purchases.edit',
            [
                'suppliers' => $suppliers,
                'products' => $products,

            ]
        );
    }

}

// if something brike look at make purchase funstion i change it from atteach to detach