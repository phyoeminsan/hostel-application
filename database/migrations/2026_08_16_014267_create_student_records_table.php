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
        Schema::create('student_records', function (Blueprint $table) {
            $table->id('record_id');
            $table->unsignedBigInteger('academic_year_id');
            $table->foreign('academic_year_id')
                  ->references('academic_year_id')
                  ->on('academic_years')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('year_id');
            $table->foreign('year_id')
                  ->references('year_id')
                  ->on('years')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
                  ->references('student_id')
                  ->on('students')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('major_id');
            $table->foreign('major_id')
                  ->references('major_id')
                  ->on('majors')
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
        Schema::dropIfExists('student_records');
    }
};
