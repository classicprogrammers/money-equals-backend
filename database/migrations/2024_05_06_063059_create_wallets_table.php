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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('account_no')->unique();
            $table->string('name');
            $table->foreignId('currency_id')->constrained('currencies'); // Assuming currencies table exists
            $table->decimal('balance', 10, 2)->default(0);
            $table->foreignId('client_id')->constrained('clients'); // Assuming clients table exists
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
