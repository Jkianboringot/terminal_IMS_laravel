<?php

namespace App\Livewire\Admin\Approvals;

use App\Models\AddProduct;
use App\Models\ActivityLog;
use App\Models\UnsuccessfulTransaction;
use Livewire\Component;

class AddApproval extends Component
{
    public $pendingAddProducts;
    public $pendingUnsuccessful;

    function mount()
    {
        $this->loadPendingRequests();
    }

    function loadPendingRequests()
    {
        $this->pendingAddProducts = AddProduct::with(['products','user'])->where('status', 'pending')->get();
        $this->pendingUnsuccessful = UnsuccessfulTransaction::with(['products','user'])->where('status', 'pending')->get();
    }

    function approve($id, $type)
    {
        try {
            if ($type === 'AddProduct') {
                $model = AddProduct::findOrFail($id);
                $model->update(['status' => 'approved']);
                $action = 'approved_add_product';
            } else {
                $model = UnsuccessfulTransaction::findOrFail($id);
                $model->update(['status' => 'approved']);
                $action = 'approved_unsuccessful_transaction';
            }

            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => $action,
                'model'  => $type,
                'model_id' => $model->id,
            ]);

            $this->loadPendingRequests();
            $this->dispatch('done', success: "Approved successfully.");
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Error: " . $th->getMessage());
        }
    }

    function reject($id, $type)
    {
        try {
            if ($type === 'AddProduct') {
                $model = AddProduct::findOrFail($id);
                $model->update(['status' => 'rejected']);
                $action = 'rejected_add_product';
            } else {
                $model = UnsuccessfulTransaction::findOrFail($id);
                $model->update(['status' => 'rejected']);
                $action = 'rejected_unsuccessful_transaction';
            }

            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => $action,
                'model'  => $type,
                'model_id' => $model->id,
            ]);

            $this->loadPendingRequests();
            $this->dispatch('done', success: "Rejected successfully.");
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Error: " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.approvals.addapproval', [
            'pendingAddProducts' => $this->pendingAddProducts,
            'pendingUnsuccessful' => $this->pendingUnsuccessful,
        ]);
    }
}
