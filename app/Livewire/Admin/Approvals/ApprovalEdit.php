<?php 
namespace App\Livewire\Admin\Approvals;

use App\Models\AddProduct;
use App\Models\EditApproval;
use App\Models\ActivityLog;
use Livewire\Component;

class ApprovalEdit extends Component
{
    public $pendingEdits;

    function mount()
    {
        $this->loadPendingEdits();
    }

    function loadPendingEdits()
    {
        $this->pendingEdits = EditApproval::with('user', 'addProduct.supplier')
            ->where('status', 'pending')
            ->get();
    }

   function approve($id)
{
    $editRequest = EditApproval::findOrFail($id);
    $changes = $editRequest->changes;

    $addProduct = AddProduct::findOrFail($editRequest->add_product_id);

    // Apply supplier/date
    $addProduct->update([
        'supplier_id' => $changes['supplier_id'],
        'add_product_date' => $changes['add_product_date'],
        'status' => 'approved', // back to normal
    ]);

    // Apply products & log changes
    foreach ($changes['products'] as $listItem) {
        $existing = $addProduct->products()
            ->where('product_id', $listItem['product_id'])
            ->first();

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
}


    function reject($id)
    {
        $edit = EditApproval::findOrFail($id);
        $edit->update(['status' => 'rejected']);

        $edit->addProduct->update(['status' => 'approved']); // revert back

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'rejected_edit_request',
            'model' => 'EditApproval',
            'model_id' => $edit->id,
        ]);

        $this->loadPendingEdits();
        $this->dispatch('done', success: "Edit request rejected.");
    }

    public function render()
    {
        return view('livewire.admin.edit-approval-list', [
            'pendingEdits' => $this->pendingEdits
        ]);
    }
}
