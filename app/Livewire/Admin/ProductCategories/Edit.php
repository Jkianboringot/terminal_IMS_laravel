<?php

namespace App\Livewire\Admin\ProductCategories;


use App\Models\ProductCategory;
use App\Traits\WithCancel;
use Livewire\Component;

class Edit extends Component
{
     use WithCancel;
    public ProductCategory $category;

    function rules()
    {
        return [
            'category.name' => 'required',
                              'category.description' => 'nullable', 




        ];
    }
    function mount($id)
    {
        $this->category = ProductCategory::find($id);
    }

    function updated()
    {
        $this->validate();
    }

    function save()
    {
        $this->validate();
        try {

            $this->category->update();

            return redirect()->route('admin.productcategories.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: 'Something went wrong: ' . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.product-categories.edit');
    }
}
