<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Supplier;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Unit;
use FontLib\Table\Type\name;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;


class Create extends Component
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

    function mount()
    {
        $this->product = new Product();
    }
    function updated()
    {
        $this->validate();
    }

    function save()
    {
        try {
            $this->validate();

            if ($this->manual_image) {
                $logoName = Str::slug($this->product->name) . '-logo.' . $this->manual_image->extension();

                $this->manual_image->storeAs('product_manual/', $logoName, 'public');

                $this->product->technical_path = "product_manual/" . $logoName;
                //saves the path and input it in the databse techinical path 
            }

            $this->product->save();

            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.products.create', [
            'productCategories' => ProductCategory::select(['id','name'])->get(),
            'units' => Unit::select(['id','name'])->get(),
            'brands' => Brand::select(['id','name'])->get(),
            'suppliers' => Supplier::select(['id','name'])->get()
                    // from all to select
        ]);
    }
}
