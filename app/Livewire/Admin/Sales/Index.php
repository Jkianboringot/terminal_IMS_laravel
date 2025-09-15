<?php

namespace App\Livewire\Admin\Sales;

use App\Models\Product;
use App\Models\Sale;
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
            $sale = Sale::findOrFail($id);
            if ($sale->is_paid) {
                throw new \Exception("Error Processing request: This Sale has already been paid for", 1);
            }

            $sale->products()->detach();
            $sale->delete();

            $this->dispatch('done', success: "Successfully Deleted this Sale");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }

    
   
      public function render()
{
    $search = trim($this->search);

   
    $sales = Sale::select('sales.*')
        ->join('customers', 'sales.customer_id', '=', 'customers.id')
        ->when($search, fn ($query) =>
            $query->where(function ($sub) use ($search) {
                $sub->where('sales.sale_date', 'like', "%$search%")
                    ->orWhere('customers.name', 'like', "%$search%");
            })
        )
        ->with(['customer:id,name']) // Only load needed fields
        ->orderBy('sales.sale_date', 'desc')
        ->paginate(10);

    return view('livewire.admin.sales.index', [
        'sales' => $sales
    ]);
}

}
