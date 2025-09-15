<?php

namespace App\Traits;

trait WithCancel
{
    public function cancel()
    {
        $this->reset('customerSearch', 'productSearch', 'selectedProductId', 'quantity', 'price', 'productList'); 
        $this->dispatch('notify', 'Operation Canceled');
    }
}
