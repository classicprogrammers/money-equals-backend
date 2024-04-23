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
            $table->string('buy');
            $table->string('sell');
            $table->decimal('market_rate', 10, 2);
            $table->decimal('suggested_exchange_rate', 10, 2);
            $table->decimal('re_quoted_rate', 10, 2);
            $table->decimal('margin', 10, 2);
            $table->decimal('revenue', 10, 2);
            $table->date('value_date');
            $table->boolean('add_beneficiaries_now')->default(false);
            $table->decimal('total_payable_amount', 10, 2);
            $table->decimal('total_fees', 10, 2);
            $table->decimal('purchase_amount_remaining', 10, 2);
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
