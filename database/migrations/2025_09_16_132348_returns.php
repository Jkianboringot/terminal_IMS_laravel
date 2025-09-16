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
      Schema::create('returns', function (Blueprint $table) {
    $table->id();
    $table->date('return_date');
    $table->enum('return_type', ['customer', 'supplier']); // who returned
    $table->text('reason')->nullable();
    $table->text('description')->nullable();
    $table->string('status')->default('pending'); // pending / approved / rejected
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
