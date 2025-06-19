<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
     function products(){
        return $this->belongsToMany(Product::class,'product_purchase');
    }

}
