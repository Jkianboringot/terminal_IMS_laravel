<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  
    protected $appends = [
        'total_amount'
    ];
    function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot(['quantity', 'unit_price']);
    }

    public function getTotalAmountAttribute()
    {
        return $this->products->sum(function ($product) {
            return $product->pivot->quantity * $product->pivot->unit_price;
        });
    }
      protected static function boot()
    {
        parent::boot();

        static::creating(function ($sale) {
            $year = now()->year;

            $lastRef = Order::whereYear('created_at', $year)->max('orders_ref');

            if ($lastRef) {
                $lastNumber = (int)substr($lastRef, 8); // grab number after year
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $sale->orders_ref ='Ord-'. $year . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        });
    }

    
}
