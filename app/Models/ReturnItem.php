<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    protected $fillable = ['return_ref', 'return_date', 'return_type', 'reason'];

    protected $appends = ['total_amount', 'total_quantity'];

  public function products()
{
    return $this->belongsToMany(Product::class, 'product_return')
        ->withPivot(['quantity', 'unit_price']);
}


    public function getTotalAmountAttribute()
    {
        return $this->products()->get()->sum(function ($product) {
            return $product->pivot->quantity * $product->pivot->unit_price;
        });
    }

    public function getTotalQuantityAttribute()
    {
        return $this->products()->get()->sum(function ($product) {
            return $product->pivot->quantity;
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($return) {
            $year = now()->year;

            $lastRef = ReturnItem::whereYear('created_at', $year)->max('return_ref');

            if ($lastRef) {
                $lastNumber = (int)substr($lastRef, 9); // after "Ret-YYYY"
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $return->return_ref = 'Ret-'.$year.str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        });
    }
}
