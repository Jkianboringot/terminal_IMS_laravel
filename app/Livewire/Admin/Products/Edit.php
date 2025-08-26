<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;


class Edit extends Component
{
    public Product $product;

   
    public $manual_image;

    use WithFileUploads;


    function rules()
    {
        return [
           'product.name' => 'required',
            'product.brand_id' => 'nullable|string',
            'product.supplier_id' => 'required',

            'product.description' => 'nullable|string',
            'product.unit_id' => 'required|integer|exists:units,id',
                // do this for every validation but becarefull it might impact the perfomacne
            'product.product_category_id' => 'nullable|string',
            'product.quantity' => 'required',
            'product.purchase_price' => 'required',
            'product.sale_price' => 'required',
            'product.location' => 'nullable|string|max:45',
            'product.barcode' => 'nullable|string|max:45',

            'product.inventory_threshold' => 'nullable|integer|min:0|max:999',


            'manual_image' => 'nullable|image|max:2048',

        ];
    }

    function mount($id)
    {
        $this->product = Product::find($id);
    }
    function updated()
    {    
        $this->validate();
    }

    function save()
    {
        // return redirect()->route('admin.products.index');
        try {
               $this->validate();

                if ($this->manual_image) {
                $productManual = Str::slug($this->product->name) . '-logo.' . $this->manual_image->extension();

                $this->manual_image->storeAs('product_manual/', $productManual, 'public');

                $this->product->technical_path = "product_manual/" . $productManual;
            }

            $this->product->update();

            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.products.edit', [
            'productCategories' => ProductCategory::all(),
            'units' => Unit::all(),
            'brands' => Brand::all(),
            'suppliers' => Supplier::all()
        
        ]);
    }
}