<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('active_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id'); // Link to the class
            $table->unsignedBigInteger('teacher_id'); // Link to the teacher
            $table->timestamp('started_at'); // When the meeting started
            $table->boolean('is_active')->default(true); // Active status
            $table->timestamps();

            // Foreign keys
            $table->foreign('class_id')->references('id')->on('klasat')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_sessions');
    }
};
