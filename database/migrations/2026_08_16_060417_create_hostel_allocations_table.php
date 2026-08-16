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
        Schema::create('hostel_allocations', function (Blueprint $table) {
            $table->id('allocation_id');
            $table->date('allocation_date');
            $table->string('status');
            $table->text('description');
            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id')
                  ->references('payment_id')
                  ->on('payments')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')
                  ->references('room_id')
                  ->on('rooms')
                  ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostel_allocations');
    }
};
