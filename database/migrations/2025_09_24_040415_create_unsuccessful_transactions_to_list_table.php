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
        Schema::create('unsuccessful_transactions_to_list', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('unsuccessful_transaction_id');

            $table->primary(['product_id', 'unsuccessful_transaction_id']);

            $table->decimal('quantity', 10, 2)->unsigned();
            $table->timestamps();

            // Short foreign key names
            $table->foreign('product_id', 'utl_product_fk')
                  ->references('id')->on('products')
                  ->onDelete('cascade');

            $table->foreign('unsuccessful_transaction_id', 'utl_txn_fk')
                  ->references('id')->on('unsuccessful_transactions')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unsuccessful_transactions_to_list');
    }
};
