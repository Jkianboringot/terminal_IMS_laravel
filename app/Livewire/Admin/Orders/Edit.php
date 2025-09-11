<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Livewire\Component;

class Edit extends Component
{
    
    public $customerSearch;
    public $productSearch;

    public $selectedProductId;

    public $quantity;
    public $price;


    public Order $order;
    public $productList = [];


    function rules()
    {
        return [
            'order.order_date'=>'required',
            'order.delivery_date'=>'nullable',
            'order.order_status'=>'required',
            'order.customer_id'=>'required',
        ];
    }



    function mount($id)
    {
        $this->order = Order::find($id);
        foreach ($this->order->products as $key => $product) {

            array_push(
                $this->productList,
                [
                    'product_id' => $product->id,
                    'quantity' => $product->pivot->quantity,
                    'price' => $product->pivot->unit_price
                ]
            );

        }
        $this->customerSearch = $this->order->customer->name;
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



    function selectCustomer($id)
    {
        $this->order->customer_id = $id;
        $this->customerSearch=$this->order->customer->name;

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
            throw new \Exception("Please fill all product fields (Product, Quantity, Price).");
        }

        foreach ($this->productList as $key => $listItem) {
            if ($listItem['product_id'] == $this->selectedProductId && $listItem['price'] == $this->price) {
                $this->productList[$key]['quantity'] += $this->quantity;
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
    } catch (\Throwable $th) {
        $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
    }
}

function save()
{
    try {
        if (!$this->order->order_date || !$this->order->customer_id) {
            throw new \Exception("Order date and customer are required.");
        }

        $this->order->update();
        $this->order->products()->detach();

        foreach ($this->productList as $listItem) {
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
        $customers = Supplier::where('name', 'like', '%' . $this->customerSearch . '%')->get();
        $products = Product::where('name', 'like', '%' . $this->productSearch . '%')->get();
 $orderOptions=[
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
]
;
        return view(
            'livewire.admin.orders.edit',
            [
                'customers' => $customers,
                'products' => $products,
                'orderOptions' => $orderOptions,



            ]
        );
    }
   

}
