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
        Schema::create('thesis_advisers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thesis_id');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('thesis_id')->references('id')->on('theses')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_advisers');
    }
};
