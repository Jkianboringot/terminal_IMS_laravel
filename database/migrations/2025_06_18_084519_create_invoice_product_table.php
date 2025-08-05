<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice_product', function (Blueprint $table) {
           $table->foreignId('invoice_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->primary(['product_id','invoice_id']);
            $table->unsignedDecimal('quantity',10,2);
                   $table->unsignedDecimal('unit_price',15,2);

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_product');
    }
};
