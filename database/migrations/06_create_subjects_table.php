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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject_id')->unique();
            $table->string('subject');
            $table->integer('credit');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->boolean('deleted')->default(false);
            $table->timestamps();
            // $table->unsignedBigInteger('major_id');
            // $table->foreign('major_id')->references('id')->on('majors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
