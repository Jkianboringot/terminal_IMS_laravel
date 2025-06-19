<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
       function products(){
        return $this->belongsToMany(Product::class,'product_quotation');
    }
}
