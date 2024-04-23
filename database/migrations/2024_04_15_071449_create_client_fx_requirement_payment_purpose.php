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
        Schema::create('client_fx_requirement_payment_purpose', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_fx_requirement_id');
            $table->unsignedBigInteger('payment_purpose_id');
            $table->timestamps();

            $table->foreign('client_fx_requirement_id', 'cfx_req_id_foreign')->references('id')->on('client_fx_requirements')->onDelete('cascade');
            $table->foreign('payment_purpose_id', 'payment_purpose_id_foreign')->references('id')->on('payment_purposes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_fx_requirement_payment_purpose');
    }
};
