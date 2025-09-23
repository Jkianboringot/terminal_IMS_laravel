<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnsuccessfulTransaction extends Model
{
    
   
      protected $fillable = ['supplier_id', 'add_product_date', 'status'];

    function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    function products()
    {
        return $this->belongsToMany(Product::class, 'add_products_to_list')
        ->withPivot(['quantity'])->withTimestamps();;
    }

    //   public function getTotalValueAttribute()
    // { #added the get cause its causing someshit
    //     return $this->products()->get()->sum(function ($product) {
    //         return $product->pivot->quantity * $product;
    //     });
    // }
    
    // public function getTotalAmountAttribute()
    // {
    //     return $this->products->sum(function ($product) {
    //         return $product->pivot->quantity * $product;
    //     });
    // }
       public function getTotalQuantityAttribute()
    {
        return $this->products()->get()->sum(function ($product) {
            return $product->pivot->quantity ;
        });
    }
    
}
