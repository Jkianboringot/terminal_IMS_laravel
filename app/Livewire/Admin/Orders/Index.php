<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
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
            $order = Order::findOrFail($id);
            // if ($order->is_paid) {
            //     throw new \Exception("Error Processing request: This Order has already been paid for", 1);
            // 

            $order->products()->detach();
            $order->delete();

            $this->dispatch('done', success: "Successfully Deleted this Order");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
         $search = trim($this->search);

    $order = Order::select('orders.*')
        ->join('suppliers', 'orders.supplier_id', '=', 'suppliers.id')
        ->when($search, fn ($query) =>
            $query->where('suppliers.name', 'like', "%$search%")
        )
        ->with(['supplier:id,name']) // Only if you display customer info in the view
        ->orderBy('suppliers.name')
        ->paginate(10);

        return view('livewire.admin.orders.index', [
            'orders' => $order
        ]);
    }
}
