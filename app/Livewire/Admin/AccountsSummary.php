<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;

class AccountsSummary extends Component
{
    public $total_revenue=0;
    public $sales_count=0;
    public $stock_value=0;
    public $overdue_invoices=0;
    public $receivables=0;
    public $loss_summary=0;

    public $instance;

    public $month;


    function updatedMonth()
    {
        $this->instance = Carbon::parse($this->month);
        
foreach (Sale::all() as $key => $sale) {
          if(Carbon::parse($sale->sale_date)->isBetween($this->instance->startOfMonth()->toDateString(),
          $this->instance->endOfMonth()->toDateString())){
                $this->total_revenue +=$sale->total_amount; 
          }
        }
        }
    


    function mount(){

        $this->instance=Carbon::now();
        foreach (Product::all() as $key => $product) {
            $this->stock_value += $product->inventory_balance*$product->purchase_price;
            $this->sales_count += $product->total_sales_count;
        }

         foreach (Sale::all() as $key => $sale) {
          if(Carbon::parse($sale->sale_date)->isBetween($this->instance->startOfMonth()->toDateString(),
          $this->instance->endOfMonth()->toDateString())){
                $this->total_revenue +=$sale->total_amount; 
          }
        }
    }

    

    public function render()
    {
        return view('livewire.admin.accounts-summary');
    }

}