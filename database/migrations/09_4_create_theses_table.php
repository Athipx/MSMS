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
        Schema::create('theses', function (Blueprint $table) {
            $table->id();
            $table->string('title_lo');
            $table->string('title_en');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('major_id');
            $table->unsignedBigInteger('gen_id');
            $table->text('description')->nullable();
            $table->enum('status', ['in_progress', 'not_pass', 'pass'])->default('in_progress');
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('teacher_id')->references('id')->on('students');
            $table->foreign('major_id')->references('id')->on('majors');
            $table->foreign('gen_id')->references('id')->on('generations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theses');
    }
};
