<?php

namespace App\Livewire\Admin\Approvals;

use App\Models\AddProduct;
use App\Models\UnsuccessfulTransaction;
use App\Models\EditApproval;
use App\Models\Approval;
use App\Models\ActivityLog;
use Livewire\Component;

class ApprovalCenter extends Component
{
    public $pendingAddProducts;
    public $pendingUnsuccessful;
    public $pendingEdits;

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

        $this->pendingEdits = EditApproval::with(['addProduct.products','user'])
            ->where('status', 'pending')->get();
    }

    function approve($id, $type)
    {
        try {
            if ($type === 'Edit') {
                $this->approveEdit($id);
            } else {
                $model = $this->resolveModel($id, $type);
                $model->update(['status' => 'approved']);

                Approval::create([
                    'user_id'        => auth()->id(),
                    'approvable_id'  => $model->id,
                    'approvable_type'=> get_class($model),
                    'status'         => 'approved',
                ]);

                ActivityLog::create([
                    'user_id'  => auth()->id(),
                    'action'   => 'approved_' . strtolower($type),
                    'model'    => $type,
                    'model_id' => $model->id,
                ]);
            }

            $this->loadPendingRequests();
            $this->dispatch('done', success: "$type approved successfully.");
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Error: " . $th->getMessage());
        }
    }

    function reject($id, $type)
    {
        try {
            $model = $this->resolveModel($id, $type);
            $model->update(['status' => 'rejected']);

            Approval::create([
                'user_id'        => auth()->id(),
                'approvable_id'  => $model->id,
                'approvable_type'=> get_class($model),
                'status'         => 'rejected',
            ]);

            ActivityLog::create([
                'user_id'  => auth()->id(),
                'action'   => 'rejected_' . strtolower($type),
                'model'    => $type,
                'model_id' => $model->id,
            ]);

            $this->loadPendingRequests();
            $this->dispatch('done', success: "$type rejected successfully.");
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Error: " . $th->getMessage());
        }
    }

    private function approveEdit($id)
    {
        $editApproval = EditApproval::with('addProduct.products')->findOrFail($id);
        $changes = $editApproval->changes;

        // Update AddProduct date if present
        if (isset($changes['add_product_date'])) {
            $editApproval->addProduct->update([
                'add_product_date' => $changes['add_product_date'],
            ]);
        }

        // Update products + quantities if present
        if (!empty($changes['products'])) {
            $syncData = [];
            foreach ($changes['products'] as $item) {
                $syncData[$item['product_id']] = [
                    'quantity' => $item['quantity']
                ];
            }
            $editApproval->addProduct->products()->sync($syncData);
        }

        // Mark edit as approved
        $editApproval->update(['status' => 'approved']);

        Approval::create([
            'user_id'        => auth()->id(),
            'approvable_id'  => $editApproval->id,
            'approvable_type'=> EditApproval::class,
            'status'         => 'approved',
        ]);

        ActivityLog::create([
            'user_id'  => auth()->id(),
            'action'   => 'approved_edit',
            'model'    => 'EditApproval',
            'model_id' => $editApproval->id,
        ]);
    }

    private function resolveModel($id, $type)
    {
        return match ($type) {
            'AddProduct'   => AddProduct::findOrFail($id),
            'Unsuccessful' => UnsuccessfulTransaction::findOrFail($id),
            'Edit'         => EditApproval::findOrFail($id),
            default        => throw new \Exception("Unknown type: $type"),
        };
    }

    public function render()
    {
        return view('livewire.admin.approvals.approval-center', [
            'pendingAddProducts' => $this->pendingAddProducts,
            'pendingUnsuccessful' => $this->pendingUnsuccessful,
            'pendingEdits' => $this->pendingEdits,
        ]);
    }
}
