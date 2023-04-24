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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname_lo');
            $table->string('lname_lo');
            $table->string('fname_en');
            $table->string('lname_en');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('profile')->nullable();
            $table->enum('role', ['admin', 'student', 'teacher', 'coordinator', 'headUnit', 'headDept'])->default('student');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->boolean('deleted')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
