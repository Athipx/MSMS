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
        Schema::create('tutitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('major_id');
            $table->unsignedBigInteger('gen_id');
            $table->unsignedBigInteger('fee_type_id');
            $table->enum('status', ['paid', 'unpaid', 'installment'])->default('unpaid');
            $table->date('due_date')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('major_id')->references('id')->on('majors')->onDelete('cascade');
            $table->foreign('gen_id')->references('id')->on('generations')->onDelete('cascade');
            $table->foreign('fee_type_id')->references('id')->on('fee_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutitions');
    }
};
