<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
  protected $fillable = ['sales_ref', 'sale_date'];
    protected $appends = [
        'total_amount'
    ];
  
    function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    function products()
    {
        return $this->belongsToMany(Product::class, 'product_sale')->withPivot(['quantity', 'unit_price']);
    }
    
    public function getTotalValueAttribute()
    { #added the get cause its causing someshit
        return $this->products()->get()->sum(function ($product) {
            return $product->pivot->quantity * $product->purchase_price;
        });
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
   
    //  function getTotalBalanceAttribute(){
    //         return $this->total_amount- $this->total_paid ;
    //     }
    //     function getIsPaidAttribute(){
    //         return $this->total_balance <= 0;
    //     }

    //     function getTotalPaidAttribute(){
    //         return $this->payments->sum(function ($payment){
    //         return $payment->pivot->amount;
    //     });
    //     }
    //       function payments(){
    //     return $this->belongsToMany(SalesPayment::class,'sale_sale_payment')->withPivot(['amount']);
    // }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($sale) {
            $year = now()->year;

            $lastRef = Sale::whereYear('created_at', $year)->max('sales_ref');

            if ($lastRef) {
                $lastNumber = (int)substr($lastRef, 4); // grab number after year
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $sale->sales_ref = 'Sal-'.$year . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        });
    }

}
