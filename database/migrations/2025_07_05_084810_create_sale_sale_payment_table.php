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
        Schema::create('sale_sale_payment', function (Blueprint $table) {
            $table->id();
             $table->foreignId('sale_id')->constrained();
             $table->foreignId('sales_payment_id')->constrained('sales_payments');
            $table->decimal('amount');

        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_sale_payment');
    }
};
