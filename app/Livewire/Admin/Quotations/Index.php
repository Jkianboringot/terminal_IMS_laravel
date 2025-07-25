<?php

namespace App\Livewire\Admin\Quotations;

use App\Models\Quotation;
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
            $quotation = Quotation::findOrFail($id);
            // if ($quotation->is_paid) {
            //     throw new \Exception("Error Processing request: This Quotation has already been paid for", 1);
    // 

            $quotation->products()->detach();
            $quotation->delete();

            $this->dispatch('done', success: "Successfully Deleted this Quotation");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
          $search = trim($this->search);

    $quotation = Quotation::select('quotations.*')
        ->join('clients', 'quotations.client_id', '=', 'clients.id')
        ->when($search, fn ($query) =>
            $query->where('clients.name', 'like', "%$search%")
        )
        ->with(['client:id,name']) // Only if you display client info in the view
        ->orderBy('clients.name')
        ->paginate(10);

        return view('livewire.admin.quotations.index',[
            'quotations'=>  $quotation
        ]);
    }
}
