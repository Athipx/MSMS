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
        Schema::create('tutition_installments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tutition_id');
            $table->string('installment');
            $table->string('amount');
            $table->string('txt_amount');
            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');
            $table->date('due_date')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->foreign('tutition_id')->references('id')->on('tutitions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutition_installments');
    }
};
