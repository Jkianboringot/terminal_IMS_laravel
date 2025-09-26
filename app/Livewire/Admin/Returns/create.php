<?php

namespace App\Livewire\Admin\Returns;

use App\Models\Product;
use App\Models\ReturnItem;
use App\Traits\ProductSearch;
use App\Traits\WithCancel;
use Livewire\Component;

class Create extends Component
{
    use ProductSearch;
    use WithCancel;

    public $productSearch = '';   // ← Add this
    public $returnSearch;
    public $selectedProductId;
    public $quantity;
    public $price;

    public ReturnItem $return;
    public $productList = [];

  protected $rules = [
        'return.return_date' => 'required|date',
        'return.return_type' => 'required|string|in:supplier,customer',
        'return.reason'      => 'nullable|string|max:255',
        'return.description' => 'nullable|string|max:500',
    ];

    function mount()
    {
        $this->return = new ReturnItem();
        $this->return->return_date = now()->toDateString();
    }

    function selectProduct($id)
    {
        $this->selectedProductId = $id;
        $product = Product::find($id);

        if ($product) {
            $this->returnSearch = $product->name;
            $this->price = $product->sale_price;
        }
    }

    function addToList()
    {
        $this->validate([
            'selectedProductId' => 'required',
            'quantity' => 'required|numeric|min:1',
        ]);

        $product = Product::find($this->selectedProductId);
        if (!$product) {
            $this->dispatch('done', error: "Product not found.");
            return;
        }

        array_push($this->productList, [
            'product_id' => $this->selectedProductId,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]);

        $this->reset([
            'selectedProductId',
            'returnSearch',
            'quantity',
            'price',
        ]);
    }

    function deleteCartItem($key)
    {
        array_splice($this->productList, $key, 1);
    }

    function save()
    {
        try {
            $this->validate();
             $this->return->status = 'pending'; 

            $this->return->save();

            foreach ($this->productList as $item) {
                $this->return->products()->attach($item['product_id'], [
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                ]);
            }

            if ($this->return->products->count() == 0) {
                $this->return->delete();
            }

            return redirect()->route('admin.returns.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Error: " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.returns.create', [
            'products' => $this->productSearch(),
        ]);
    }
}
