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
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('roll_no')->unique(); // UCSPL-001
            $table->string('name');
             $table->unsignedBigInteger('major_id');
            $table->foreign('major_id')
                  ->references('major_id')
                  ->on('majors')
                  ->onDelete('cascade');
            $table->string('gender');
            $table->string('nrc');
            $table->date('date_of_birth')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('address');
            $table->string('profile');
            $table->string('email');
            $table->string('password');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
