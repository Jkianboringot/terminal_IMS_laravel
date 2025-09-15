<?php

namespace App\Traits;

use App\Models\Product;

trait ProductSearch
{
    public function productSearch(){
        return  Product::where(function ($q) {
            $q->where('name', 'like', '%' . $this->productSearch . '%')
                ->orWhere('description', 'like', '%' . $this->productSearch . '%');
        })->get();
    }
}
