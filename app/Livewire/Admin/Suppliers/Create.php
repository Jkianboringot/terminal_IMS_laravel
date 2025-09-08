<?php

namespace App\Livewire\Admin\Suppliers;

use App\Models\Supplier;
use App\Traits\WithCancel;
use Livewire\Component;

class Create extends Component
{
    use WithCancel;

    public Supplier $supplier;

    function rules()
    {
        return [
            'supplier.name' => "required",
            'supplier.email' => "required|unique:suppliers,email",
            'supplier.address' => "required",
            'supplier.phone_number' => "required",
            'supplier.tax_id' => "required",
            'supplier.account_number' => "required",
        ];
    }

    function mount()
    {
        $this->supplier = new Supplier();
    }

    function updated()
    {
        $this->validate();
    }

    function save()
    {
        $this->validate();
        try {
            $this->supplier->save();
            return redirect()->route('admin.suppliers.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view(
            'livewire.admin.suppliers.create'
        );
    }
}