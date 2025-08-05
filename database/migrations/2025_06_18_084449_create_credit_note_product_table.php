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
        Schema::create('credit_note_product', function (Blueprint $table) {
            $table->foreignId('credit_note_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->primary(['product_id','credit_note_id']);
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
        Schema::dropIfExists('credit_note_product');
    }
};
