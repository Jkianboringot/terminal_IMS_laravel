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
        ->join('clients', 'invoices.client_id', '=', 'clients.id')
        ->when($search, fn ($query) =>
            $query->where('clients.name', 'like', "%$search%")
        )
        ->with(['client:id,name']) // Only if you display client info in the view
        ->orderBy('clients.name')
        ->paginate(10);

    return view('livewire.admin.invoices.index', [
        'invoices' => $invoices
    ]);
}

}
