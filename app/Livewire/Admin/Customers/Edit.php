<?php

namespace App\Livewire\Admin\Customers;

use App\Models\Customer;
use App\Traits\WithCancel;
use Illuminate\Validation\Rules\Unique;
use Livewire\Component;

class Edit extends Component
{
    use WithCancel;
    public Customer $customer;

    function rules()
    {
        return [
            'customer.name' => 'required|string',

            'customer.email' => 'required|string',
            'customer.address' => 'nullable|string|max:85',
            'customer.phone_number' => 'nullable|string|max:20',
            'customer.tax_id' => 'required|string',

            'customer.organization_type' => 'nullable|string', // i will allow this to be null incase customer is not affiated with an org




        ];
    }
    function mount($id)
    {
        $this->customer = Customer::find($id);
    }

    function updated()
    {
        $this->validate();
    }

    function save()
    {
        $this->validate();
        try {

            $this->customer->update();

            return redirect()->route('admin.customers.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: 'Something went wrong: ' . $th->getMessage());
        }
    }
    public function render()
    {
        $organization_types = ['Government', 'Private', 'NGO', 'COOPERATIVE'];

        return view('livewire.admin.customers.create', [
            'organization_types' => $organization_types
        ]);
    }
}
