<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class Index extends Component
{

    
    
         function downloadOrder($id)
    {
        try {
            $order = Order::findOrFail($id);

            $pdf=Pdf::loadView('pdf.invoice',$data);
            $this->dispatch('done', success: "Successfully Deleted this Order");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
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
        return view('livewire.admin.orders.index',[
            'orders'=>Order::all()
        ]);
    }
}

