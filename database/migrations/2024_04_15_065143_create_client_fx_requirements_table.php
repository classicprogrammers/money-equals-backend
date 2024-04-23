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
        Schema::create('client_fx_requirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
           
            $table->unsignedBigInteger('payment_per_month_id');
            $table->foreign('payment_per_month_id')->references('id')->on('payment_per_months')->onDelete('cascade');
            $table->unsignedBigInteger('payment_schedule_id');
            $table->foreign('payment_schedule_id')->references('id')->on('payment_schedules')->onDelete('cascade');
            $table->unsignedBigInteger('price_range_id');
            $table->foreign('price_range_id')->references('id')->on('price_ranges')->onDelete('cascade');
            $table->unsignedBigInteger('medium_id');
            $table->foreign('medium_id')->references('id')->on('media')->onDelete('cascade');
            // Add other columns as needed
            $table->timestamps();
        });

       
        
    

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_fx_requirement_payment_purpose');
        // Drop other pivot tables here
        Schema::dropIfExists('client_fx_requirements');
    }
};
