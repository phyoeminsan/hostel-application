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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->string('payment_method');
            $table->string('amount');
            $table->string('payment_slip');
            $table->string('transaction_no');
            $table->date('payment_date');
            $table->text('reason');
            $table->string('status');
            $table->unsignedBigInteger('application_id');
            $table->foreign('application_id')
                  ->references('application_id')
                  ->on('hostel_applications')
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
        Schema::dropIfExists('payments');
    }
};
