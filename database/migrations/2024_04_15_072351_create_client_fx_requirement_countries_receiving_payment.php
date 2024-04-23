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
        Schema::create('client_fx_requirement_countries_receiving_payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_fx_requirement_id');
            $table->unsignedBigInteger('country_id');
            $table->timestamps();

            // Define custom names for foreign key constraints
            $table->foreign('client_fx_requirement_id', 'fk_cfr_countries_receiving_payment_cfr')->references('id')->on('client_fx_requirements')->onDelete('cascade');
            $table->foreign('country_id', 'fk_cfr_countries_receiving_payment_country')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_fx_requirement_countries_receiving_payment');
    }
};
