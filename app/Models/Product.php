<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // App\Models\StickyNote.php


    protected $appends=[
        'total_purchase_count',
        'total_sales_count',
        'inventory_balance',
         'manual_url',
    ];
    function brand()
    {
        return $this->belongsTo(Brand::class);
    }

       function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    function sales()
    {
        return $this->belongsToMany(Sale::class, 'product_sale')->withPivot(['quantity', 'unit_price']);
    }

    function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'product_purchase')->withPivot(['quantity', 'unit_price']);
    }

    function quotations()
    {
        return $this->belongsToMany(Quotation::class, 'product_quotation')->withPivot(['quantity', 'unit_price']);
    }
    function deliveryNotes()
    {
        return $this->belongsToMany(DeliveryNote::class, 'delivery_note_product');
    }

    function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')->withPivot(['quantity', 'unit_price']);
    }

    function creditNotes()
    {
        return $this->belongsToMany(CreditNote::class, 'credit_note_product');
    }

    function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_product')->withPivot(['quantity', 'unit_price']);
    }

    function getTotalPurchaseCountAttribute()
    {
        $amount = 0;
        foreach ($this->purchases as $purchase) {
            $amount += ($purchase->pivot->quantity  );

        }
        return $amount;
    }

    function getTotalSalesCountAttribute()
    {
        $amount = 0;
        foreach ($this->sales as $sale) {
            $amount += ($sale->pivot->quantity );
        }
        return $amount;
    }

    function getInventoryBalanceAttribute()
    {
        return $this->total_purchase_count - $this->total_sales_count;
    }
  public function getManualUrlAttribute()
{
    if ($this->technical_path && file_exists(public_path($this->technical_path))) {
        return asset($this->technical_path);
        //the problem is in where
    }

    return null;
}
    protected function defaultProfilePhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=7F9CF5&background=EBF4FF';
    }
}

