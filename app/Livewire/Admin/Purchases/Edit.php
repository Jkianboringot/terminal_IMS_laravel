<?php

namespace App\Livewire\Admin\Purchases;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Traits\WithCancel;
use Livewire\Component;
use App\Models\ActivityLog;

class Edit extends Component
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
            'purchase.date_settled' => 'required',
            'purchase.supplier_id' => 'required',
            'purchase.is_paid' => 'nullable',

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
        if ($this->productList[$key]['quantity'] > 1) {
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

    $product = Product::find($id);

    if ($product) {
        $this->productSearch = $product->name;
        $this->price = $product->purchase_price; 
    }
}
    function addToList()
    {
        try {
            if (!$this->selectedProductId || !$this->quantity || !$this->price) {
                throw new \Exception('All product fields are required.');
            }

            foreach ($this->productList as $key => $item) {
                if ($item['product_id'] == $this->selectedProductId && $item['price'] == $this->price) {
                    $this->productList[$key]['quantity'] += $this->quantity;
                    $this->reset(['selectedProductId', 'productSearch', 'quantity', 'price']);
                    return;
                }
            }

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
            if (!$this->purchase->purchase_date || !$this->purchase->supplier_id) {
                throw new \Exception('Purchase Date and Supplier are required.');
            }

            if (empty($this->productList)) {
                throw new \Exception('You must add at least one product to the list.');
            }

            $this->purchase->update();

            $oldProducts = $this->purchase->products()
                ->get()
                ->mapWithKeys(function ($p) {
                    return [$p->id => [
                        'quantity'   => $p->pivot->quantity,
                        'unit_price' => $p->pivot->unit_price,
                    ]];
                })
                ->toArray();

            // Prepare new pivot data
            $newProducts = [];
            foreach ($this->productList as $listItem) {
                $newProducts[$listItem['product_id']] = [
                    'quantity'   => $listItem['quantity'],
                    'unit_price' => $listItem['price'],
                ];
            }

            // Sync products
            $this->purchase->products()->sync($newProducts);

            // Detect changes
            $changes = [
                'added'   => array_diff_key($newProducts, $oldProducts),
                'removed' => array_diff_key($oldProducts, $newProducts),
                'updated' => [],
            ];

            foreach ($newProducts as $id => $data) {
                if (isset($oldProducts[$id]) && $oldProducts[$id] != $data) {
                    $changes['updated'][$id] = [
                        'old' => $oldProducts[$id],
                        'new' => $data,
                    ];
                }
            }

            // Only log if there are changes
            if (!empty($changes['added']) || !empty($changes['removed']) || !empty($changes['updated'])) {
                ActivityLog::create([
                    'user_id'   => auth()->id(),
                    'action'    => 'purchase_updated',
                    'model'     => 'Purchase',
                    'model_id'  => $this->purchase->id,
                    'changes'   => json_encode($changes),
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
            'Overdue',
            'Failed',
            'Refunded',
            'Canceled / Voided',
            'Processing'
        ];
        return view(
            'livewire.admin.purchases.edit',
            [
                'suppliers' => $suppliers,
                'products' => $products,
                'paidOptions' => $paidOptions,

            ]
        );
    }
}

// if something brike look at make purchase funstion i change it from atteach to detach