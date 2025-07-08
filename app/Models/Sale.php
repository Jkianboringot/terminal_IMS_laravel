<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    protected $appends = [
        'total_amount'
    ];
    function client()
    {
        return $this->belongsTo(Client::class);
    }
    function products()
    {
        return $this->belongsToMany(Product::class, 'product_sale')->withPivot(['quantity', 'unit_price']);
    }

    public function getTotalAmountAttribute()
    { #added the get cause its causing someshit
        return $this->products()->get()->sum(function ($product) {
            return $product->pivot->quantity * $product->pivot->unit_price;
        });
    }
     public function getTotalQuantityAttribute()
    {
        return $this->products()->get()->sum(function ($product) {
            return $product->pivot->quantity ;
        });
    }
   
     function getTotalBalanceAttribute(){
            return $this->total_amount- $this->total_paid ;
        }
        function getIsPaidAttribute(){
            return $this->total_balance <= 0;
        }

        function getTotalPaidAttribute(){
            return $this->payments->sum(function ($payment){
            return $payment->pivot->amount;
        });
        }
          function payments(){
        return $this->belongsToMany(SalesPayment::class,'sale_sale_payment')->withPivot(['amount']);
    }
}
