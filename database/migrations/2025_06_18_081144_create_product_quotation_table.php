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
        Schema::create('product_quotation', function (Blueprint $table) {
            $table->foreignId('quotation_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->primary(['product_id','quotation_id']);
            $table->decimal('quantity');
                        $table->decimal('unit_price',15,2);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_quotation');
    }
};
