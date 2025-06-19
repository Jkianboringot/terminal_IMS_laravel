<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
       function products(){
        return $this->belongsToMany(Product::class,'invoice_product');
    }
}
