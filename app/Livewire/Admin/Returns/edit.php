<?php

namespace App\Livewire\Admin\Returns;

use App\Models\Product;
use App\Models\ReturnItem;
use App\Traits\ProductSearch;
use App\Traits\WithCancel;
use Livewire\Component;

class Edit extends Component
{
    use ProductSearch, WithCancel;

    public $returnSearch;
    public $selectedProductId;
    public $quantity;
    public $price;
    public $restock = true;

    public ReturnItem $return;
    public $productList = [];

    function rules()
    {
        return [
            'return.return_date' => 'required|date',
            'return.return_type' => 'required|in:customer,supplier',
        ];
    }

    function mount(ReturnItem $return)
    {
        $this->return = $return;
        $this->productList = $return->products->map(function ($product) {
            return [
                'product_id' => $product->id,
                'quantity' => $product->pivot->quantity,
                'price' => $product->pivot->unit_price,
                'restock' => $product->pivot->restock
            ];
        })->toArray();
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
            'restock' => $this->restock
        ]);

        $this->reset([
            'selectedProductId',
            'returnSearch',
            'quantity',
            'price',
            'restock'
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

            $this->return->save();

            $this->return->products()->detach();

            foreach ($this->productList as $item) {
                $this->return->products()->attach($item['product_id'], [
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'restock' => $item['restock']
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
        return view('livewire.admin.returns.edit', [
            'products' => $this->productSearch(),
        ]);
    }
}
