<?php

namespace App\Livewire\Admin\Purchases;

use App\Models\ActivityLog;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Traits\WithCancel;
use Livewire\Component;

class Create extends Component
{
    use WithCancel;
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
            'purchase.date_settled' => 'nullable',
            'purchase.supplier_id' => 'required',
            'purchase.is_paid' => 'required',

        ];
    }



    function mount()
    {
        $this->purchase = new Purchase();
        $this->purchase->purchase_date = now()->toDateString();
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


    function selectSupplier($id)
    {
        $this->purchase->supplier_id = $id;
        $this->supplierSearch = $this->purchase->supplier->name;
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
            $this->validate([
                'selectedProductId' => 'required',
                'quantity' => 'required',
            ]);

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

    function save()
    {
        try {
            $this->validate();

            if (empty($this->purchase->purchase_date)) {
                $this->purchase->purchase_date = now()->toDateString();
            }

            $this->purchase->save();

            foreach ($this->productList as $key => $listItem) {
                $this->purchase->products()->attach($listItem['product_id'], [
                    'quantity'   => $listItem['quantity'],
                    'unit_price' => $listItem['price'],
                ]);

                // ✅ Log activity
                ActivityLog::create([
                    'user_id'    => auth()->id(),
                    'action'     => 'purchase_product_added',
                    'model'      => 'Purchase',
                    'model_id'   => $this->purchase->id,
                    'changes'    => json_encode([
                        'product_id' => $listItem['product_id'],
                        'quantity'   => $listItem['quantity'],
                        'unit_price' => $listItem['price'],
                    ]),
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->header('User-Agent'),
                ]);
            }

            return redirect()->route('admin.purchases.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        $suppliers = Supplier::where('name', 'like', '%' . $this->supplierSearch . '%')->get();
        $products = Product::where('name', 'like', '%' . $this->productSearch . '%')->get();
        $paidOptions = [
            'Paid',
            'Unpaid / Pending',
            'Partially Paid',
            'Processing'
        ];
        return view(
            'livewire.admin.purchases.create',
            [
                'suppliers' => $suppliers,
                'products' => $products,
                'paidOptions' => $paidOptions,

            ]
        );
    }
}
