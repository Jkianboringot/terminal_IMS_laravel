<?php

namespace App\Livewire\Admin\Suppliers;

use App\Models\Supplier;
use App\Traits\WithCancel;
use Livewire\Component;

class Edit extends Component
{
    use WithCancel;
        public Supplier $supplier;

    function rules()
    {
        return [
            'supplier.name' => "required|string",
            'supplier.email' => "required",
            'supplier.address' => "required",
            'supplier.phone_number' => "required|string",
            'supplier.tax_id' => "required|string",
            'supplier.account_number' => "required|string",
        ];
    }

    function mount($id)
    {
        $this->supplier = Supplier::find($id);
    }

    function updated()
    {
        $this->validate();
    }

    function save()
    {
        $this->validate();
        try {
            $this->supplier->update();
            return redirect()->route('admin.suppliers.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.suppliers.edit');
    }
}