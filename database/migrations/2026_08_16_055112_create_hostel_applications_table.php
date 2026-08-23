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
        Schema::create('hostel_applications', function (Blueprint $table) {
            $table->id('application_id');
            $table->unsignedBigInteger('record_id');
            $table->foreign('record_id')
                  ->references('record_id')
                  ->on('student_records')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('hostel_id');
            $table->foreign('hostel_id')
                  ->references('hostel_id')
                  ->on('hostels')
                  ->onDelete('cascade');
            $table->date('apply_date');
            $table->string('status');
            $table->string('reason');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostel_applications');
    }
};
