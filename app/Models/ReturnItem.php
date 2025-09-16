<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    protected $table = 'returns';

    function products()
    {
        return $this->belongsToMany(Product::class, 'product_return')
                    ->withPivot(['quantity', 'unit_price', 'restock']);
    }
}
