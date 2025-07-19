<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
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
            $brand = Brand::findOrFail($id);
            if (count($brand->products) >0 ) {
                throw new \Exception("Permission denied: This Brand has {$brand->products->count()} Product ", 1);
            }

       
            $brand->delete();

            $this->dispatch('done', success: "Successfully Deleted this Brand");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
   public function render()
{
    $search = trim($this->search);

    $brand = Brand::when($search, fn ($query) =>
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%");
        })
    )
    ->orderBy('name')
    ->paginate(10);

    return view('livewire.admin.brands.index', [
        'brands' => $brand
    ]);
}
}
