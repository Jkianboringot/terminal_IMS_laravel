<?php

namespace App\Livewire\Admin\Customers;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
       public string $search = '';

       public function updatingSearch()
    {
        // Reset pagination when search input changes
        $this->resetPage();
    }
      function delete($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            if (count($customer->sales) >0 ) {
                throw new \Exception("Permission : This Customer has Bought from you {$customer->sales->count()} Customer ", 1);
            }

       
            $customer->delete();

            $this->dispatch('done', success: "Successfully Deleted this Customer");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
      $search = trim($this->search);

$customers = Customer::when($search, fn ($query) =>
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%");
        })
    )
    ->orderBy('name')
    ->paginate(10);
    


        return view('livewire.admin.customers.index',[
            'customers'=>$customers]);
    }
}

// Change all customer name to Customer
