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
       Schema::create('return_items', function (Blueprint $table) {
    $table->id();
    $table->string('return_ref');
  $table->foreignId('sale_id')->nullable()->constrained();

    $table->date('return_date');
        $table->enum('return_type', ['customer', 'supplier']); // <--- add this
     $table->enum('status', ['pending', 'approved', 'rejected','pending_edit'])->default('pending');

    $table->text('reason')->nullable();
    $table->text('description')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_items');
    }
};
