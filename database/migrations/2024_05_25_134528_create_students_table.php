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
            $table->string('student_name', 50);
            $table->integer('student_age');
            $table->string('student_gender', 10);
            $table->string('student_birthRegNo', 10);
            $table->string('student_ic', 12);
            $table->string('student_health', 30);
            $table->string('student_birthPlace', 30);
            $table->string('student_homeAddress',50);
            $table->enum('student_regStatus',["Pending","Approved","Rejected"])->nullable();
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
