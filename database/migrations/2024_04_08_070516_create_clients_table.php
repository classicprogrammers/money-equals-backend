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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('phone_no');
            $table->string('postcode');
            $table->string('email');
            $table->string('address');
            $table->string('business_name');
            $table->string('registration_no')->nullable();
            $table->unsignedBigInteger('country_id'); // Make nullable
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->string('post_code');
            $table->unsignedBigInteger('payment_type_id'); // Make nullable
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('set null');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('set null');
            $table->string('business_address');
            $table->string('website')->nullable();
            $table->string('business_phone_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
