<?php

namespace App\Livewire\Admin\Purchases;

use App\Models\Purchase;
use Livewire\Component;

class Edit extends Component
{
    
     public Purchase $purchase;

    function rules()
    {
        return [
            'purchase.name' => 'required',
        
            'purchase.description' => 'required',
            'purchase.unit_id' => 'required',
            'purchase.purchase_category_id' => 'required',
            'purchase.quantity' => 'required',
            'purchase.purchase_price' => 'required',
            'purchase.sale_price' => 'required',
        ];
    }

    function mount()
    {
        $this->purchase = new Purchase();
    }
    function updated()
    {
        $this->validate();
    }

    function save()
    {
        try {
            $this->validate();

            $this->purchase->update();

            return redirect()->route('admin.purchases.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.purchases.edit');
    }
}
