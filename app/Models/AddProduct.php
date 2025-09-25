<?php

namespace App\Models;

use App\Livewire\Admin\Approvals\AddApproval;
use Illuminate\Database\Eloquent\Model;

class AddProduct extends Model
{
   
      protected $fillable = [ 'add_product_date', 'status'];

    
public function approvals()
{
    return $this->morphMany(AddApproval::class, 'approvable');
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
