<?php

namespace App\Models;

use App\Livewire\Admin\Approvals\AddApproval;
use Illuminate\Database\Eloquent\Model;

class UnsuccessfulTransaction extends Model
{
    
   
      protected $fillable = [ 'unsuccessful_transactions_date', 'status'];

public function approvals()
{
    return $this->morphMany(Approval::class, 'approvable');
}

    function products()
    {
        return $this->belongsToMany(Product::class, 'unsuccessful_transactions_to_list')
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
