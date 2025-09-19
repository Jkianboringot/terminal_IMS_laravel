<?php

namespace App\Livewire\Admin\AddProducts;

use App\Models\Product;
use App\Models\AddProduct;
use App\Models\Supplier;
use App\Traits\ProductSearch;
use App\Traits\WithCancel;
use Livewire\Component;

class Create extends Component
{
    use ProductSearch;
    use WithCancel;
    public $supplierSearch;
    public $productSearch;
    
    public $selectedProductId;

    public $quantity;



    public AddProduct $addProduct;

    
    public $productList = [];


    function rules(){
        return [
            'addProduct.add_product_date'=>'required',
            'addProduct.supplier_id'=>'required',
        ];
    }



    function mount()
    {
        $this->addProduct = new AddProduct();
    $this->addProduct->add_product_date = now()->toDateString();

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

    function deleteCartItem($key){
        array_splice($this->productList,$key,1);
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
            $this->validate([
                'selectedProductId' => 'required',
                'quantity' => 'required',
               
            ]);

         foreach ($this->productList as $key => $listItem) {
    if ($listItem['product_id']==$this->selectedProductId ) {
        $this->productList[$key]['quantity']+=$this->quantity;
        return;
    }
}



            array_push($this->productList, [
                'product_id' => $this->selectedProductId,
                'quantity' => $this->quantity,
                
            ]);

            $this->reset([
                'selectedProductId',
                'productSearch',
                'quantity',
          
            ]);
        } catch (\Throwable $th) {
             $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
function save()
{
    try {
        $this->validate();

        if (empty($this->addProduct->add_product_date)) {
       $this->addProduct->add_product_date = now()->toDateString();

        }   
  $this->addProduct->status = 'pending'; // 🔹 default request status
        $this->addProduct->save();


        foreach ($this->productList as $key => $listItem) {
            $this->addProduct->products()->attach($listItem['product_id'], [
                'quantity' => $listItem['quantity'],
            ]);

          //make this a function
            \App\Models\ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'stock_added',
                'model' => 'Product',
                'model_id' => $listItem['product_id'],
                'changes' => json_encode([
                    'added_quantity' => $listItem['quantity'],
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
      
        return view(
            'livewire.admin.add-products.create',
            [
                'suppliers' => $suppliers,
                               'products' => $this->productSearch(),


            ]
        );
    }
}
