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
        Schema::create('meeting_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_id'); // Link to the meeting session
            $table->unsignedBigInteger('user_id'); // Link to the user
            $table->timestamp('joined_at')->default(DB::raw('CURRENT_TIMESTAMP')); // Koha e hyrjes
            $table->timestamps();

            $table->foreign('meeting_id')->references('id')->on('active_sessions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_participants');
    }
};
