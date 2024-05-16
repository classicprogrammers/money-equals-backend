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
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); // Client who grants the permission
            $table->unsignedBigInteger('granted_user_id'); // User who receives the permission
            $table->boolean('online_access')->default(false);
            $table->boolean('rates')->default(false);
            $table->boolean('deal_booking')->default(false);
            $table->string('user_type')->nullable(); // Additional user type if needed
            $table->timestamps();

                    // Define foreign key constraints
                    $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
                    $table->foreign('granted_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_permissions');
    }
};
