<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Models\Unit;
use App\Traits\WithCancel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
{
     use WithCancel;
    public Product $product;
    public $manual_image;

    use WithFileUploads;

    function rules()
    {
        return [
            'product.name' => 'required|string',
            'product.brand_id' => 'nullable',
            'product.supplier_id' => 'required',

            'product.description' => 'nullable|string',
            'product.unit_id' => 'required|integer|exists:units,id',
            // do this for every validation but becarefull it might impact the perfomacne
            'product.product_category_id' => 'nullable',
            'product.quantity' => 'required|numeric',
            'product.purchase_price' => 'required|numeric',
            'product.sale_price' => 'required|numeric',
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

    function save()
    {
        try {
            $this->validate(); // ✅ Only validate on save()

            // Handle manual image upload if any
            if ($this->manual_image) {
                $productManual = Str::slug($this->product->name) . '-logo.' . $this->manual_image->extension();
                $this->manual_image->storeAs('product_manual/', $productManual, 'public');
                $this->product->technical_path = "product_manual/" . $productManual;
            }

           
            $oldQty = $this->product->getOriginal('quantity');

            $this->product->update();
 
            $newQty = $this->product->quantity;

            if ($newQty > $oldQty) {
                $diff = $newQty - $oldQty;
                \App\Models\ActivityLog::create([
                    'user_id' => auth()->id(),
                    'action' => 'stock_added',
                    'model' => 'Product',
                    'model_id' => $this->product->id,
                    'changes' => json_encode([
                        'added_quantity' => $diff,
                        'old_quantity' => $oldQty,
                        'new_quantity' => $newQty
                    ]),
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->header('User-Agent'),
                ]);
            } elseif ($newQty < $oldQty) {
                $diff = $oldQty - $newQty;
                \App\Models\ActivityLog::create([
                    'user_id' => auth()->id(),
                    'action' => 'stock_removed',
                    'model' => 'Product',
                    'model_id' => $this->product->id,
                    'changes' => json_encode([
                        'removed_quantity' => $diff,
                        'old_quantity' => $oldQty,
                        'new_quantity' => $newQty
                    ]),
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->header('User-Agent'),
                ]);
            }

            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.products.edit', [
            'productCategories' => ProductCategory::select(['id','name'])->get(),
            'units' => Unit::select(['id','name'])->get(),
            'brands' => Brand::select(['id','name'])->get(),
            'suppliers' => Supplier::select(['id','name'])->get()
        ]);
    }
}
