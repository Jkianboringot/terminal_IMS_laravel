<?php

namespace App\Livewire\Admin\Approvals;

use App\Models\AddProduct;
use App\Models\ActivityLog;
use Livewire\Component;

class AddApproval extends Component
{
    public $pendingRequests;

    function mount()
    {
        $this->loadPendingRequests();
    }

    function loadPendingRequests()
    {
        $this->pendingRequests = AddProduct::with('supplier', 'products')
            ->where('status', 'pending')
            ->get();
    }

    function approve($id)
    {
        try {
            $addProduct = AddProduct::findOrFail($id);
            $addProduct->update(['status' => 'approved']);

            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'approved_add_product',
                'model' => 'AddProduct',
                'model_id' => $addProduct->id,
            ]);

            $this->loadPendingRequests();
            $this->dispatch('done', success: "Product approved successfully.");
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    function reject($id)
    {
        try {
            $addProduct = AddProduct::findOrFail($id);
            $addProduct->update(['status' => 'rejected']);

            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'rejected_add_product',
                'model' => 'AddProduct',
                'model_id' => $addProduct->id,
            ]);

            $this->loadPendingRequests();
            $this->dispatch('done', success: "Product rejected successfully.");
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.approvals.addapproval', [
            'pendingRequests' => $this->pendingRequests
        ]);
    }
}
