<?php 
namespace App\Livewire\Admin\Approvals;

use App\Models\AddProduct;
use App\Models\EditApproval;
use App\Models\ActivityLog;
use Livewire\Component;
use Exception;

class ApprovalEdit extends Component
{
    public $pendingEdits;

    function mount()
    {
        $this->loadPendingEdits();
    }

function loadPendingEdits()
{
    $this->pendingEdits = EditApproval::with([
        'user',
        'addProduct.supplier',
        'addProduct.products' // eager load products
    ])
        ->where('status', 'pending')
        ->get();
}


    function approve($id)
    {
        try {
            $editRequest = EditApproval::findOrFail($id);
            $changes = $editRequest->changes;

            $addProduct = AddProduct::findOrFail($editRequest->add_product_id);

            // Apply supplier/date
            $addProduct->update([
                'supplier_id' => $changes['supplier_id'],
                'add_product_date' => $changes['add_product_date'],
                'status' => 'approved',
            ]);

            // Apply products & log changes
        foreach ($changes['products'] as $listItem) {
    $product = $addProduct->products()->find($listItem['product_id']); 
    $productName = $product ? $product->name : "Unknown Product";

    $existing = $product;
    $oldQuantity = $existing ? $existing->pivot->quantity : 0;
    $newQuantity = $listItem['quantity'];

    $addProduct->products()->syncWithoutDetaching([
        $listItem['product_id'] => ['quantity' => $newQuantity],
    ]);

    if ($newQuantity != $oldQuantity) {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'edit_approved',
            'model' => 'AddProduct',
            'model_id' => $listItem['product_id'],
            'changes' => json_encode([
                'product_name' => $productName,
                'old_quantity' => $oldQuantity,
                'new_quantity' => $newQuantity,
                'change' => $newQuantity - $oldQuantity,
            ]),
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }
}


            $editRequest->update(['status' => 'approved']);

            $this->loadPendingEdits();
            $this->dispatch('done', success: "Edit request approved.");
        } catch (Exception $e) {
            $this->dispatch('done', error: "Approval failed: " . $e->getMessage());
        }
    }

    function reject($id)
    {
        try {
            $edit = EditApproval::findOrFail($id);
            $edit->update(['status' => 'rejected']);

            $edit->addProduct->update(['status' => 'approved']); // revert

            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'rejected_edit_request',
                'model' => 'EditApproval',
                'model_id' => $edit->id,
            ]);

            $this->loadPendingEdits();
            $this->dispatch('done', success: "Edit request rejected.");
        } catch (Exception $e) {
            $this->dispatch('done', error: "Rejection failed: " . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.approvals.approvaledit', [
            'pendingEdits' => $this->pendingEdits
        ]);
    }
}
