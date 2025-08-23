<?php

namespace App\Livewire\Admin\SalePayments;

use App\Models\SalePayment;
use App\Models\SalesPayment;
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
            $sale_payment = SalesPayment::findOrFail($id);
          

            $sale_payment->sales()->detach();
       
            $sale_payment->delete();

            $this->dispatch('done', success: "Successfully Deleted this SalePayment");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }public function render()
{
    $search = trim($this->search);

    $salesPayments = SalesPayment::query()
        ->select('sales_payments.*')
        ->join('customers', 'sales_payments.customer_id', '=', 'customers.id')
        ->when($search, fn($q) => $q->where(function ($sub) use ($search) {
            $sub->where('sales_payments.transaction_reference', 'like', "%{$search}%")
                ->orWhere('customers.name', 'like', "%{$search}%");
        }))
        ->with(['customer:id,name']) // Only name needed
        ->orderBy('sales_payments.payment_time', 'desc')
        ->paginate(10);

    return view('livewire.admin.sale-payments.index', [
        'sales_payments' => $salesPayments,
    ]);
}



}
