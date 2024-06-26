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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->decimal('buy_amount', 10, 2)->nullable(); // Renamed from 'buy'
            $table->string('buy_currency')->default('USD'); // New column for buy currency
            $table->decimal('sell_amount', 10, 2)->nullable(); // Renamed from 'sell'
            $table->string('sell_currency')->default('USD');  // New column for sell currency
            $table->decimal('market_rate', 10, 2)->nullable();
            $table->decimal('suggested_exchange_rate', 10, 2)->nullable();
            $table->decimal('re_quoted_rate', 10, 2)->nullable();
            $table->decimal('margin', 10, 2)->nullable();
            $table->decimal('revenue', 10, 2)->nullable();
            $table->date('value_date')->default(now());
            $table->unsignedBigInteger('client_id'); // Not nullable
            $table->unsignedBigInteger('beneficiary_id')->nullable();
            $table->foreign('beneficiary_id')->references('id')->on('beneficiaries')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->decimal('total_payable_amount', 10, 2);
            $table->string('amount_currency')->default('USD');
            $table->string('unique_identifier')->nullable();
            $table->decimal('total_fees', 10, 2)->nullable();
            $table->string('status')->default('Awaiting Funds');
            $table->decimal('purchase_amount_remaining', 10, 2)->nullable();
            $table->string('payment_reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
