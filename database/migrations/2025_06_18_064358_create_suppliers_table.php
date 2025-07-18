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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
              $table->string('name');
          $table->string('email')->unique();
          $table->text('address');
          $table->string('phone_number');
          $table->string('registration_number')->nullable();
          $table->string('tax_id');
          $table->foreignId('bank_id')->constrained();
          $table->string('account_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
