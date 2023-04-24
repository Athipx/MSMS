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
        Schema::create('student_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('major_id');
            $table->unsignedBigInteger('gen_id');
            $table->unsignedBigInteger('fee_type_id');
            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');
            $table->date('due_date')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->boolean('deleted')->default(false);
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
        Schema::dropIfExists('student_fees');
    }
};
