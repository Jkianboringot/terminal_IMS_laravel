<?php

namespace App\Livewire\Admin\Suppliers;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
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
            $supplier = Supplier::findOrFail(id: $id);
            if (count($supplier->purchases) >0) {
                throw new \Exception("Permission denied: This Supplier has {$supplier->purchases->count()} Product", 1);
            }

       
            $supplier->delete();

            $this->dispatch('done', success: "Successfully Deleted this Supplier");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
         $search = trim($this->search);

    $supplier = Supplier::with(['bank:id,name'])
        ->when($search, fn ($query) =>
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhereHas('bank', fn ($q2) =>
                      $q2->where('name', 'like', "%$search%")
                  );
            })
        )
        ->orderBy('name')
        ->paginate(10);
        return view('livewire.admin.suppliers.index',[
    'suppliers'=>$supplier]);
    }
}
