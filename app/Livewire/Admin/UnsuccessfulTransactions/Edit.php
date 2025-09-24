<?php

namespace App\Livewire\Admin\UnsuccessfulTransactions;

use App\Models\EditApproval;
use App\Models\Product;
use App\Models\UnsuccessfulTransaction;
use App\Models\Supplier;
use App\Traits\ProductSearch;
use App\Traits\WithCancel;
use Livewire\Component;

class Edit extends Component
{
    use ProductSearch;
    use WithCancel; 

    public $productSearch;

    public $selectedProductId;

    public $quantity;
    public $price;


    public UnsuccessfulTransaction $unsuccessfulTransaction;
    public $productList = [];


    function rules()
    {
        return [
         'unsuccessfulTransaction.add_product_date'=>'required|date',
        ];
    }



    function mount($id)
    {
        $this->unsuccessfulTransaction = UnsuccessfulTransaction::find($id);
        foreach ($this->unsuccessfulTransaction->products as $key => $product) {

            array_push(
                $this->productList,
                [
                    'product_id' => $product->id,
                    'quantity' => $product->pivot->quantity,
                 
                ]
            );

        }
          $this->unsuccessfulTransaction->add_product_date = now()->toDateString();
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
        $this->productSearch=Product::find($id)->name;

    }
function addToList()
{
    try {
 if (empty($this->unsuccessfulTransaction->add_product_date)) {
       $this->unsuccessfulTransaction->add_product_date = now()->toDateString();

        }           // Manual checks to replace validate()
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
function save()
{
    try {
        $changes = [
            'add_product_date' => $this->unsuccessfulTransaction->add_product_date,
            'products' => $this->productList,
        ];

        EditApproval::create([
            'add_product_id' => $this->unsuccessfulTransaction->id,
            'user_id' => auth()->id(),
            'changes' => $changes,
            'status' => 'pending',
        ]);

        $this->unsuccessfulTransaction->update(['status' => 'pending']);

        return redirect()->route('admin.unsuccessful-transactions.index')
            ->with('success', 'Edit request submitted for approval.');
    } catch (\Throwable $th) {
        $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
    }
}

    public function render()
    {
     

        return view(
            'livewire.admin.unsuccessful-transactions.edit',
         
        );
    }

}

// if something brike look at make unsuccessfulTransaction funstion i change it from atteach to detach