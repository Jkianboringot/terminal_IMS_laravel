<?php

namespace App\Livewire\Admin\PurchasePayments;

use App\Models\PurchasePayment;
use App\Models\Supplier;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
{
    public $supplierSearch;
    public $selectedPurchaseId;
    public $amount;
    public PurchasePayment $purchase_payment;

    public $purchaseList=[];

    function rules(){
        return [
            'purchase_payment.supplier_id'=>'required',
            'purchase_payment.transaction_reference'=>'required',
            'purchase_payment.payment_time'=>'required',
            'purchase_payment.amount'=>'required',
        ];
    }
      function selectSupplier($id)
    {
        $this->purchase_payment->supplier_id = $id;
    }

    function mount(){
        $this->purchase_payment=new PurchasePayment();
        $this->purchase_payment->payment_time=Carbon::now()->toDatetimeLocalString(); 
        // this for others to where it automatically input the current time
    }


    function addToList()
    {
        try {
            $this->validate([
                'selectedPurchaseId' => 'required',
                'amount' => 'required',
        
            ]);

            foreach ($this->purchaseList as $key => $listItem) {
                if ($listItem['purchase_id']==$this->selectedPurchaseId && $listItem['amount']==$this->amount) {
                    $this->purchaseList[$key]['amount']+=$this->amount;
                return;
                    # code...
                }
            }


            array_push($this->purchaseList, [
                'purchase_id' => $this->selectedPurchaseId,
                'amount' => $this->amount,
              
            ]);

            $this->reset([
                'selectedPurchaseId',
               
                'amount',
              
            ]);
        } catch (\Throwable $th) {
             $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }


   function save()
    {
        $this->validate();
        try {
            $this->purchase_payment->permissions=json_encode($this->selected_permissions);
            
            $this->purchase_payment->save();
          
            $this->dispatch('purchase_payment-created', message: 'Purchase_payment created successfully!');
       
            return redirect()->route('admin.purchase_payments.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: 'Something went wrong: ' . $th->getMessage());
        }
    }
    public function render()
    {
        $suppliers = Supplier::where('name', 'like', '%' . $this->supplierSearch . '%')->get();

        return view('livewire.admin.purchase-payments.create',[
            'suppliers'=>$suppliers 
        ]);
    }
}
