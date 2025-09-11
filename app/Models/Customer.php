<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
       function orders(){
        return $this->hasMany(Order::class);
    }

         function sales(){
        return $this->hasMany(Sale::class);
    }

          function payments()
    {
        return $this->hasMany(SalesPayment::class);
    }

        public function getTotalAmountAttribute()
    {
        return $this->sales()->get()->sum(function ($sale) {
            return $sale->total_amount;
        });
    }

        function getTotalPaidAttribute(){
            return $this->payments->sum(function ($payment){
            return $payment->amount;
        });
        }

       function getTotalBalanceAttribute()
    {
            return $this->total_amount - $this->total_paid; 
    }

    
}
