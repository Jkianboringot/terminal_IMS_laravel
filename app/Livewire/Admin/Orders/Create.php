<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class Create extends Component
{
    public $customerSearch;
    public $productSearch;
    
    public $selectedProductId;
    public $quantity;
    public $price;

    public Order $order;
    public $productList = [];

    // 🔹 Added same as Sales
    public $overrideLowStock = false;
    public $pendingAction = null;

    function rules()
    {
        return [
            'order.order_date' => 'required',
            'order.delivery_date' => 'nullable',
            'order.order_status' => 'required',
            'order.customer_id' => 'required',
        ];
    }

    function mount()
    {
        $this->order = new Order();
        $this->order->order_date = now()->toDateString();
    }

    function addQuantity($key)
    {
        $product = Product::find($this->productList[$key]['product_id']);
        $newQty = $this->productList[$key]['quantity'] + 1;

        // 🚨 Hard stop if overstock
        if ($product->inventory_balance < $newQty) {
            session()->flash('warning', "Not enough stock for {$product->name}. Available: {$product->inventory_balance}.");
            return;
        }

        // ⚠️ Soft warning if going below 10
        if (($product->inventory_balance - $newQty) < 10 && !$this->overrideLowStock) {
            session()->flash('warning', "Adding this will bring {$product->name} below 10 in stock.");
            $this->pendingAction = ['type' => 'addQuantity', 'key' => $key];
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

    function selectCustomer($id)
    {
        $this->order->customer_id = $id;
        $this->customerSearch = $this->order->customer->name;
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
                'price' => 'required',
            ]);

            $product = Product::find($this->selectedProductId);

            if (!$product) {
                $this->dispatch('done', error: "Warning: Product not found.");
                return;
            }

            // 🚨 Hard stop if overstock
            if ($product->inventory_balance < $this->quantity) {
                $this->dispatch('done', error: "Warning: Inventory balance for {$product->name} is too low.");
                return;
            }

            // ⚠️ Soft warning if stock would fall below 10
            if (($product->inventory_balance - $this->quantity) < 10 && !$this->overrideLowStock) {
                session()->flash('warning', "Adding this will bring {$product->name} below 10 in stock.");
                $this->pendingAction = ['type' => 'addToList'];
                return;
            }

            foreach ($this->productList as $key => $listItem) {
                if ($listItem['product_id'] == $this->selectedProductId && $listItem['price'] == $this->price) {
                    $this->productList[$key]['quantity'] += $this->quantity;
                    $this->overrideLowStock = false;
                    return;
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

            $this->overrideLowStock = false;
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    // 🔹 Allow "continue anyway"
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
            $this->order->save();

            foreach ($this->productList as $key => $listItem) {
                $this->order->products()->attach($listItem['product_id'], [
                    'quantity' => $listItem['quantity'],
                    'unit_price' => $listItem['price']
                ]);
            }

            return redirect()->route('admin.orders.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    public function render()
    {
        $customers = Customer::where('name', 'like', '%' . $this->customerSearch . '%')->get();
        $products = Product::where('name', 'like', '%' . $this->productSearch . '%')->get();
        $orderOptions = [
            'Pending',
            'Confirmed',
            'Processing',
            'On Hold',
            'Shipped',
            'Delivered',
            'Delivery Failed',
            'Completed',
            'Returned',
            'Refunded',
            'Cancelled',
            'Declined'
        ];

        return view(
            'livewire.admin.orders.create',
            [
                'customers' => $customers,
                'products' => $products,
                'orderOptions' => $orderOptions,
            ]
        );
    }
}


