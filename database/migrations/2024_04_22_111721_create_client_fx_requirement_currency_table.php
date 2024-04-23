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
        Schema::create('client_fx_requirement_currency', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_fx_requirement_id');
            $table->unsignedBigInteger('currency_id');
            $table->timestamps();

            $table->foreign('client_fx_requirement_id', 'fk_cfr_currency_client_fx_requirement')
                ->references('id')->on('client_fx_requirements')
                ->onDelete('cascade');

            $table->foreign('currency_id', 'fk_cfr_currency_currency')
                ->references('id')->on('currencies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_fx_requirement_currency');
    }
};
