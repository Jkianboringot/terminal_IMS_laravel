<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['product_id', 'message'];

    protected $appends = [
        'inventory_balance',
        'total_purchase_count',
        'total_sales_count',
        'inventory_threshold',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Delegate computed fields
    public function getInventoryBalanceAttribute()
    {
        return $this->product ? $this->product->inventory_balance : null;
    }

    public function getTotalPurchaseCountAttribute()
    {
        return $this->product ? $this->product->total_purchase_count : null;
    }

    public function getTotalSalesCountAttribute()
    {
        return $this->product ? $this->product->total_sales_count : null;
    }

    public function getInventoryThresholdAttribute()
    {
        return $this->product ? $this->product->inventory_threshold : null;
    }
}
