<?php

namespace App\Livewire\Admin\Invoices;

use App\Models\Invoice;
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

    public function delete($id): void
    {
        try {
            $invoice = Invoice::findOrFail($id);

            if ($invoice->is_paid) {
                throw new \Exception("This Invoice has already been paid for.");
            }

            $invoice->products()->detach();
            $invoice->delete();

            $this->dispatch('done', success: "Successfully deleted this invoice.");
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Error: " . $th->getMessage());
        }
    }
public function render()
{
    $search = trim($this->search);

    $invoices = Invoice::select('invoices.*')
        ->join('customers', 'invoices.customer_id', '=', 'customers.id')
        ->when($search, fn ($query) =>
            $query->where('customers.name', 'like', "%$search%")
        )
        ->with(['customer:id,name']) // Only if you display customer info in the view
        ->orderBy('customers.name')
        ->paginate(10);

    return view('livewire.admin.invoices.index', [
        'invoices' => $invoices
    ]);
}

}
