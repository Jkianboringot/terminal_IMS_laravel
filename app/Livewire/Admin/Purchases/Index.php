<?php

namespace App\Livewire\Admin\Purchases;

use App\Models\Purchase;
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
            $purchase = Purchase::findOrFail($id);
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

        $purchases = Purchase::select('purchases.*')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->when(
                $search,
                fn($query) =>
                $query->where(function ($sub) use ($search) {
                    $sub->where('purchases.purchase_date', 'like', "%$search%")
                        ->orWhere('suppliers.name', 'like', "%$search%");
                })
            )
            ->with(['supplier:id,name']) // Only load needed fields
            ->orderBy('purchases.purchase_date', 'desc')
            ->paginate(10);

        return view('livewire.admin.purchases.index', [
            'purchases' => $purchases
        ]);
    }
}
