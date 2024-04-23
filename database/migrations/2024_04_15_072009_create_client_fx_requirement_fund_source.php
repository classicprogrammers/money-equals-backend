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
        Schema::create('client_fx_requirement_fund_source', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_fx_requirement_id');
            $table->unsignedBigInteger('fund_source_id');
            $table->timestamps();

            $table->foreign('client_fx_requirement_id', 'fk_cfr_fund_client_fx_requirement')->references('id')->on('client_fx_requirements')->onDelete('cascade');
            $table->foreign('fund_source_id', 'fk_cfr_fund_fund_source')->references('id')->on('fund_sources')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_fx_requirement_fund_source');
    }
};
