<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;


class Edit extends Component
{
    public Product $product;

    public $technical_image;

    use WithFileUploads;


    function rules()
    {
        return [
            'product.name' => 'required',
            'product.brand_id' => 'required',
           
            'product.description' => 'required',
            'product.unit_id' => 'required',
            'product.product_category_id' => 'required',
            'product.quantity' => 'required',
            'product.purchase_price' => 'required',
            'product.sale_price' => 'required',
            'technical_image' => 'nullable|image|max:2048',

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

              if ($this->technical_image) {
                $productManual = Str::slug($this->product->name) . '-manual.' . $this->technical_image->extension();

                $this->technical_image->storeAs('product_manual', $productManual, 'public');

                $this->product->technical_path = "product_manual" . $productManual;
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
        
        ]);
    }
}