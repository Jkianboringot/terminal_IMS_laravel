<?php

    namespace App\Livewire\Admin\AddProducts;

    use App\Models\AddProduct;
    use App\Models\Product;
    use Livewire\Component;
    use Livewire\WithPagination;

    class Index extends Component
    {
        use WithPagination;

        public string $search = '';

        public function updatingSearch(): void
        {
            $this->resetPage();
        }

        function delete($id)
        {
            try {
                $purchase = AddProduct::findOrFail($id);
                if ($purchase->is_paid) {
                    throw new \Exception("Error Processing request: This Purchase has already been paid for", 1);
                }

                $purchase->products()->detach();
                $purchase->delete();

                $this->dispatch('done', success: "Successfully Deleted this Purchase");
            } catch (\Throwable $th) {
                //throw $th;
                $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
            }
        }
       public function render()
{
    $search = trim($this->search);

    $addProducts = AddProduct::select('add_products.*')
        ->join('suppliers', 'add_products.supplier_id', '=', 'suppliers.id')
        ->when($search, fn ($query) =>
            $query->where(function ($sub) use ($search) {
                $sub->where('add_products.purchase_date', 'like', "%$search%")
                    ->orWhere('suppliers.name', 'like', "%$search%");
            })
        )
        ->with(['supplier:id,name']) // Only load needed fields
        ->orderBy('add_products.purchase_date', 'desc')
        ->paginate(10);


    return view('livewire.admin.add-products.index', [
        'addProducts' => $addProducts,
        'products' => Product::all(),

    ]);
}

    }