<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;

class AccountsSummary extends Component
{
    public $total_revenue=0;
    public $sales_count=0;
    public $stock_value=0;
    public $overdue_invoices=0;
    public $receivables=0;
    public $loss_summary=0;

    function mount(){

        foreach (Product::all() as $key => $product) {
            $this->stock_value += $product->inventory_balance*$product->purchase_price;
            $this->sales_count = $product->total_sale_value;
        }

         foreach (Sale::all() as $key => $sale) {
            $this->total_revenue += $sale->total_amount;
        }

    }

    public function render()
    {
        return view('livewire.admin.accounts-summary');
    }
}
