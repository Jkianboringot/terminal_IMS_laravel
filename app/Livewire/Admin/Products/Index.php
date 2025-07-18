<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
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

    public function delete($id)
    {
        try {
            $product = Product::findOrFail($id);

            if ($product->purchases()->exists() || $product->sales()->exists()) {
                throw new \Exception("Permission: This product has been bought and/or sold.");
            }

            $product->delete();

            $this->dispatch('done', success: "Successfully deleted the product.");
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }

   public function render()
{
    $search = trim($this->search);

    $products = Product::with(['category:id,name', 'unit:id,name'])
        ->when($search, fn ($query) =>
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhereHas('category', fn ($q2) =>
                      $q2->where('name', 'like', "%$search%")
                  );
            })
        )
        ->orderBy('name')
        ->paginate(10);

    return view('livewire.admin.products.index', [
        'products' => $products,
    ]);
}

}
