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
        Schema::create('student_grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assign_id');
            $table->unsignedBigInteger('student_id');
            $table->enum('grade', ['N/A', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F', 'I'])->default('A');
            $table->enum('old_grade', ['ບໍ່ໄດ້ອັບເກຣດ', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F', 'I'])->default('ບໍ່ໄດ້ອັບເກຣດ');
            $table->date('upgrade_date')->nullable();
            $table->text('description')->nullable();
            $table->boolean('deleted')->default(false);
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->foreign('assign_id')->references('id')->on('assigns');
            $table->foreign('student_id')->references('id')->on('students');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_grades');
    }
};
