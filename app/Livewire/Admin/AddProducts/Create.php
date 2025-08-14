<?php

namespace App\Livewire\Admin\AddProducts;

use App\Models\Product;
use App\Models\AddProduct;
use App\Models\Supplier;
use Livewire\Component;

class Create extends Component
{
    public $supplierSearch;
    public $productSearch;
    
    public $selectedProductId;

    public $quantity;
    public $price;


    public AddProduct $addProduct;
    public $productList = [];


    function rules(){
        return [
            'addProduct.purchase_date'=>'required',
            'addProduct.supplier_id'=>'required',
        ];
    }



    function mount()
    {
        $this->addProduct = new AddProduct();
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
                    # code...
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

    function makePurchase(){
        
        try {
            $this->validate();
            $this->addProduct->save();
            foreach ($this->productList as $key => $listItem) {
                $this->addProduct->products()->attach($listItem['product_id'],[
                    'quantity'=>$listItem['quantity'],
                
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
            'livewire.admin.add-products.create',
            [
                'suppliers' => $suppliers,
                'products' => $products,

            ]
        );
    }
}
