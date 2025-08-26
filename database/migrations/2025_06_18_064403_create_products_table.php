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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained(); 
            $table->foreignId('supplier_id')->constrained();


            $table->foreignId('product_category_id')->nullable()->constrained();
            $table->string('name');
            $table->text('description')->nullable();
             $table->integer('inventory_threshold')->nullable();

            $table->foreignId('unit_id')->constrained();
            $table->decimal('quantity', 10, 2)->unsigned();
            $table->decimal('purchase_price', 10, 2)->unsigned();
            $table->decimal('sale_price', 10, 2)->unsigned();


            $table->string('technical_path')->nullable();
            $table->string('location')->nullable();
            $table->string('barcode')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
