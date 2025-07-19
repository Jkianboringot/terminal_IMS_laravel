<?php

namespace App\Livewire\Admin\PurchasePayments;

use App\Models\PurchasePayment;
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
            $purchase_payment = PurchasePayment::findOrFail($id);
          

            $purchase_payment->purchases()->detach();
       
            $purchase_payment->delete();

            $this->dispatch('done', success: "Successfully Deleted this PurchasePayment");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
public function render()
{
    $search = trim($this->search);

    $purchasePayments = PurchasePayment::query()
        ->select('purchase_payments.*')
        ->join('suppliers', 'purchase_payments.supplier_id', '=', 'suppliers.id')
        ->when($search, fn($q) => $q->where(function ($sub) use ($search) {
            $sub->where('purchase_payments.transaction_reference', 'like', "%{$search}%")
                ->orWhere('suppliers.name', 'like', "%{$search}%");
        }))
        ->with(['supplier:id,name']) // Only name needed
        ->orderBy('purchase_payments.payment_time', 'desc')
        ->paginate(10);

    return view('livewire.admin.purchase-payments.index', [
        'purchase_payments' => $purchasePayments,
    ]);
}

}
