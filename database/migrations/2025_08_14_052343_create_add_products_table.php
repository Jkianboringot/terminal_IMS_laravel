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
        Schema::create('add_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained();
     $table->enum('status', ['pending', 'approved', 'rejected','pending_edit'])->default('pending');
            $table->date('add_product_date')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_products');
    }
};
