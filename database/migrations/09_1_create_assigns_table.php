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
        Schema::create('assigns', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('major_id');
            $table->unsignedBigInteger('gen_id');
            $table->unsignedBigInteger('semister_id');
            $table->unsignedBigInteger('classroom_id');
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->string('hours');
            $table->text('description')->nullable();
            $table->boolean('deleted')->default(false);
            // $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('major_id')->references('id')->on('majors');
            $table->foreign('gen_id')->references('id')->on('generations');
            $table->foreign('semister_id')->references('id')->on('semisters');
            $table->foreign('classroom_id')->references('id')->on('classrooms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigns');
    }
};
