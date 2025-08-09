<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['product_id', 'message'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
