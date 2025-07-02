<?php

namespace App\Livewire\Admin\Suppliers;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithoutUrlPagination;
      function delete($id)
    {
        try {
            $supplier = Supplier::findOrFail(id: $id);
            if (count($supplier->purchases) >0) {
                throw new \Exception("Permission denied: This Supplier has {$supplier->purchases->count()} Product", 1);
            }

       
            $supplier->delete();

            $this->dispatch('done', success: "Successfully Deleted this supplier");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.suppliers.index',[
    'suppliers'=>Supplier::paginate(10)]);
    }
}
