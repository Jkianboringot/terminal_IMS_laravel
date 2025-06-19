<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
       function brand(){
        return $this->belongsTo(Brand::class);
    }

     function unit(){
        return $this->belongsTo(Unit::class);
    }

     function category(){
        return $this->belongsTo(ProductCategory::class);
    }

     function sales(){
        return $this->belongsToMany(Sale::class, 'product_sale');
    }
    
     function purchases(){
        return $this->belongsToMany(Purchase::class, 'product_purchase');
    }

     function quotations(){
        return $this->belongsToMany(Quotation::class, 'product_quotation');
    }
 function deliveryNotes(){
        return $this->belongsToMany(DeliveryNote::class, 'delivery_note_product');
    }       
    
    function orders(){
        return $this->belongsToMany(Order::class, 'order_product');
    }      

    function creditNotes(){
        return $this->belongsToMany(CreditNote::class, 'credit_note_product');
    }      

      function invoices(){
        return $this->belongsToMany(Invoice::class, 'invoice_product');
    }      

}