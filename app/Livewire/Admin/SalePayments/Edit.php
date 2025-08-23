<?php

namespace App\Livewire\Admin\SalePayments;

use App\Models\Sale;
use App\Models\SalePayment;
use App\Models\Customer;
use App\Models\SalesPayment;
use Carbon\Carbon;
use Livewire\Component;

class Edit extends Component
{
    public $customerSearch;
    public $selectedSaleId;
    public $amount;
    public SalesPayment $sale_payment;

    public $saleList = [];

    function rules()
    {
        return [
            'sale_payment.customer_id' => 'required',
            'sale_payment.transaction_reference' => 'required',
            'sale_payment.payment_time' => 'required',
            'sale_payment.amount' => 'required',
        ];
    }

    function selectCustomer($id)
    {
        $this->sale_payment->customer_id = $id;
        $this->customerSearch = $this->sale_payment->customer->name;
    }

    function takeBalance()
    {
        if ($this->selectedSaleId) {
            $this->amount = Sale::find($this->selectedSaleId)->total_balance;
            foreach ($this->saleList as $key => $listItem) {
                if ($listItem['sale_id'] == $this->selectedSaleId) {
                    $this->amount = Sale::find($listItem['sale_id'])->total_balance - $listItem['amount'];
                }
            }
        }
    }
    function takeFullBalance()
    {
        $total = 0;
        foreach ($this->saleList as $key => $item) {
            $total += $item['amount'];
        }
        $this->sale_payment->amount = $total;
    }

    function mount($id)
    {
        $this->sale_payment = SalesPayment::find(id: $id);
        foreach ($this->sale_payment->sales as $key => $sale) {

            array_push($this->saleList, [
                'sale_id' => $sale->id,
                'amount' => $sale->pivot->amount,
            ]);
        }
        $this->customerSearch = $this->sale_payment->customer->name;
    }

    function addToList()
    {
        try {
            if (Sale::find($this->selectedSaleId)->total_balance < $this->amount) {
                throw new \Exception("Total Balance is Low", 1);
            }
            foreach ($this->saleList as $key => $listItem) {
                $newBalance = Sale::find($listItem['sale_id'])->total_balance - $listItem['amount'];
                if ($listItem['sale_id'] == $this->selectedSaleId && $newBalance < $this->amount) {
                    throw new \Exception("Total Balance is Low", 1);
                }
            }
            foreach ($this->saleList as $key => $listItem) {
                if ($listItem['sale_id'] == $this->selectedSaleId) {
                    $this->saleList[$key]['amount'] += $this->amount;
                    return;
                }
            }



            array_push($this->saleList, [
                'sale_id' => $this->selectedSaleId,
                'amount' => $this->amount,
            ]);

            $this->reset([
                'selectedSaleId',
                'amount',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    function deleteListItem($key)
    {
        array_splice($this->saleList, $key, 1);
    }



    function savePayment()
    {
        try {
            // $this->validate([
            //     'sale_payment.customer_id' => 'required',
            //     'sale_payment.transaction_reference' => 'required',
            //     'sale_payment.payment_time' => 'required',
            //     'sale_payment.amount' => 'required',
            // ]);
            foreach ($this->saleList as $key => $listItem) {
                if (!in_array($listItem['sale_id'], Customer::find($this->sale_payment->customer_id)->sales()->pluck('id')->toArray())) {
                    throw new \Exception("This Customer doesn't have all these sales", 1);
                }
            }
            $this->sale_payment->save();

            $syncData = [];
            foreach ($this->saleList as $listItem) {
                $syncData[$listItem['sale_id']] = ['amount' => $listItem['amount']];
            }
            $this->sale_payment->sales()->sync($syncData);
            return redirect()->route('admin.sale-payments.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        $customers = Customer::where('name', 'like', '%' . $this->customerSearch . '%')->get();
        return view('livewire.admin.sale-payments.edit', [
            'customers' => $customers
        ]);
    }
}