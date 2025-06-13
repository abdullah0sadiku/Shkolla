<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_media_table.php
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->string('photo')->nullable(); // Optional photo
            $table->unsignedBigInteger('user_id');
            $table->string('user_name');
            $table->timestamps();
        
            // Foreign key for user ID
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
