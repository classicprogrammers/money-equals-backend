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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('currency_id');
            $table->string('full_name')->nullable();
            $table->string('business_name')->nullable();
            $table->string('beneficiary_address');
            $table->string('email')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('iban_account_no');
            $table->string('default_payment_reference');
            $table->string('swift_code')->nullable();

            // Define foreign key constraints
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            // Define other foreign key constraints as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
