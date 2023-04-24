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
        Schema::create('presentation_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thesis_id');
            $table->enum('type', ['proposal', 'thesis']);
            $table->string('round')->nullable();
            $table->date('date');
            // $table->string('committees');
            $table->enum('status', ['pass', 'not_pass']);
            $table->text('comment');
            $table->foreign('thesis_id')
                ->references('id')
                ->on('theses')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presentation_logs');
    }
};
