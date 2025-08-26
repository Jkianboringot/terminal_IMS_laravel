<?php

namespace App\Livewire\Admin\AddProducts;

use App\Models\Product;
use App\Models\AddProduct;
use App\Models\Supplier;
use Livewire\Component;

class Edit extends Component
{
    public $supplierSearch;
    public $productSearch;

    public $selectedProductId;

    public $quantity;
    public $price;


    public AddProduct $addProduct;
    public $productList = [];


    function rules()
    {
        return [
            'add_products.purchase_date' => 'nullable',
            'add_products.supplier_id' => 'nullalbe',
        ];
    }



    function mount($id)
    {
        $this->addProduct = AddProduct::find($id);
        foreach ($this->addProduct->products as $key => $product) {

            array_push(
                $this->productList,
                [
                    'product_id' => $product->id,
                    'quantity' => $product->pivot->quantity,
                 
                ]
            );

        }
        $this->supplierSearch = $this->addProduct->supplier->name;
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
        $this->addProduct->supplier_id = $id;
               $this->supplierSearch = $this->addProduct->supplier->name;
        

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

  function addProductToList()
{
    try {
        $this->validate();
        $this->addProduct->save();

        foreach ($this->productList as $listItem) {
            // Check if the product already exists in pivot
            $existing = $this->addProduct->products()
                ->where('product_id', $listItem['product_id'])
                ->first();

            $oldQuantity = $existing ? $existing->pivot->quantity : 0;
            $newQuantity = $listItem['quantity'];

            // Attach or update pivot
            $this->addProduct->products()->syncWithoutDetaching([
                $listItem['product_id'] => [
                    'quantity' => $newQuantity,
                ]
            ]);

            // Determine if there's a change
            if ($newQuantity > $oldQuantity) {
                $action = 'stock_added';
                $changeQty = $newQuantity - $oldQuantity;
            } elseif ($newQuantity < $oldQuantity) {
                $action = 'stock_removed';
                $changeQty = $oldQuantity - $newQuantity;
            } else {
                continue; // No change → skip logging
            }

            // ✅ Log Stock Change
            \App\Models\ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => $action,
                'model' => 'Product',
                'model_id' => $listItem['product_id'],
                'changes' => json_encode([
                    'old_quantity' => $oldQuantity,
                    'new_quantity' => $newQuantity,
                    'change' => $changeQty,
                ]),
                'ip_address' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
            ]);
        }

        return redirect()->route('admin.add-products.index');

    } catch (\Throwable $th) {
        $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
    }
}


    public function render()
    {
        $suppliers = Supplier::where('name', 'like', '%' . $this->supplierSearch . '%')->get();
        $products = Product::where('name', 'like', '%' . $this->productSearch . '%')->get();

        return view(
            'livewire.admin.add-products.edit',
            [
                'suppliers' => $suppliers,
                'products' => $products,

            ]
        );
    }

}

// if something brike look at make addProduct funstion i change it from atteach to detach