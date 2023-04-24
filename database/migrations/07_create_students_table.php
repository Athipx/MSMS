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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('student_id')->unique()->nullable();
            $table->unsignedBigInteger('gen_id');
            $table->unsignedBigInteger('major_id');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->date('dob')->nullable();
            $table->date('begin_date')->nullable();
            $table->date('graduated_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('born_village')->nullable();
            $table->string('born_district')->nullable();
            $table->enum('born_province', ['ນະຄອນຫຼວງວຽງຈັນ', 'ຜົ້ງສາລີ', 'ຫຼວງນໍ້າທາ', 'ບໍ່ແກ້ວ', 'ອຸດົມໄຊ', 'ໄຊຍະບູລີ', 'ຫົວພັນ', 'ຊຽງຂວາງ', 'ຫຼວງພະບາງ', 'ໄຊສົມບູນ', 'ວຽງຈັນ', 'ບໍລິຄຳໄຊ', 'ຄຳມ່ວນ', 'ສະຫວັນນະເຂດ', 'ສາລະວັນ', 'ຈຳປາສັກ', 'ເຊກອງ', 'ອັດຕະປື'])->default('ນະຄອນຫຼວງວຽງຈັນ');
            $table->string('current_village')->nullable();
            $table->string('current_district')->nullable();
            $table->enum('current_province', ['ນະຄອນຫຼວງວຽງຈັນ', 'ຜົ້ງສາລີ', 'ຫຼວງນໍ້າທາ', 'ບໍ່ແກ້ວ', 'ອຸດົມໄຊ', 'ໄຊຍະບູລີ', 'ຫົວພັນ', 'ຊຽງຂວາງ', 'ຫຼວງພະບາງ', 'ໄຊສົມບູນ', 'ວຽງຈັນ', 'ບໍລິຄຳໄຊ', 'ຄຳມ່ວນ', 'ສະຫວັນນະເຂດ', 'ສາລະວັນ', 'ຈຳປາສັກ', 'ເຊກອງ', 'ອັດຕະປື'])->default('ນະຄອນຫຼວງວຽງຈັນ');
            $table->string('bd_major')->nullable();
            $table->string('bd_academy')->nullable();
            $table->string('bd_grade')->nullable();
            $table->string('bd_graduated_year')->nullable();
            // $table->enum('bd_certificate', ['already', 'not_yet'])->default('not_yet');
            $table->enum('working_org', ['private', 'government'])->default('private');
            $table->string('working_place')->nullable();
            $table->string('working_duration')->nullable();
            $table->date('expire_date')->nullable();
            $table->date('renew_date')->nullable();
            $table->enum('status', ['pending', 'studying', 'graduated', 'drop', 'quit'])->default('pending');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('gen_id')->references('id')->on('generations');
            $table->foreign('major_id')->references('id')->on('majors');
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
