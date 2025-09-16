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
          Schema::create('product_return', function (Blueprint $table) {
    $table->foreignId('product_id')->constrained();
    $table->foreignId('return_id')->constrained();
    $table->decimal('quantity', 10, 2)->unsigned();
    $table->decimal('unit_price', 10, 2)->unsigned()->nullable(); // if you want value tracking
    $table->boolean('restock')->default(true); // if true, goes back to inventory
    $table->timestamps();
});


        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returned_items');
    }
};
