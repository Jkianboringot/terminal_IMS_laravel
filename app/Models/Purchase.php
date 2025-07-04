<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    protected $appends = [
        'total_amount'
    ];
    function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    function products()
    {
        return $this->belongsToMany(Product::class, 'product_purchase')->withPivot(['quantity', 'unit_price']);
    }

    public function getTotalAmountAttribute()
    {
        return $this->products->sum(function ($product) {
            return $product->pivot->quantity * $product->pivot->unit_price;
        });
    }
       public function getTotalQuantityAttribute()
    {
        return $this->products()->get()->sum(function ($product) {
            return $product->pivot->quantity ;
        });
    }
   
        function getIsPaidAttribute(){
            return $this->id % 2==0;
        }

}