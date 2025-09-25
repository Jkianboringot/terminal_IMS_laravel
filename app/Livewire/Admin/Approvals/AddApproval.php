<?php

namespace App\Livewire\Admin\Approvals;

use App\Models\AddProduct;
use App\Models\ActivityLog;
use App\Models\UnsuccessfulTransaction;
use App\Models\Approval; // ✅ Import the Approval model
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
        $this->pendingAddProducts = AddProduct::with('products')
            ->where('status', 'pending')->get();

        $this->pendingUnsuccessful = UnsuccessfulTransaction::with('products')
            ->where('status', 'pending')->get();
    }

    function approve($id, $type)
    {
        try {
            if ($type === 'AddProduct') {
                $model = AddProduct::findOrFail($id);
            } else {
                $model = UnsuccessfulTransaction::findOrFail($id);
            }

            $model->update(['status' => 'approved']);

            // ✅ Save to approvals table
            Approval::create([
                'user_id' => auth()->id(),
                'approvable_id' => $model->id,
                'approvable_type' => get_class($model),
                'status' => 'approved',
            ]);

            // ✅ Activity log
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'approved_' . strtolower(class_basename($model)),
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
            } else {
                $model = UnsuccessfulTransaction::findOrFail($id);
            }

            $model->update(['status' => 'rejected']);

            // ✅ Save to approvals table
            Approval::create([
                'user_id' => auth()->id(),
                'approvable_id' => $model->id,
                'approvable_type' => get_class($model),
                'status' => 'rejected',
            ]);

            // ✅ Activity log
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'rejected_' . strtolower(class_basename($model)),
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
