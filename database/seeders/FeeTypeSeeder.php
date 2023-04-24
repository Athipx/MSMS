<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fee_types')->insert(
            [
                [
                    'type' => 'ຄ່າລົງທະບຽນ ມຊ',
                    'amount' => '210000',
                    'txt_amount' => 'ສອງແສນສິບພັນ',
                    'modified_by' => 1
                ],
                [
                    'type' => 'ຄ່າລົງທະບຽນ ຄວສ',
                    'amount' => '140000',
                    'txt_amount' => 'ໜຶ່ງແສນສີ່ສິບພັນ',
                    'modified_by' => 1
                ],
                [
                    'type' => 'ຄ່າຟອມສະໝັກ',
                    'amount' => '20000',
                    'txt_amount' => 'ຊາວພັນ',
                    'modified_by' => 1
                ],
                [
                    'type' => 'ຄ່າລົງບັດນັກສຶກສາ',
                    'amount' => '150000',
                    'txt_amount' => 'ສິບຫ້າພັນ',
                    'modified_by' => 1
                ],
                [
                    'type' => 'ຄ່າຮຽນ',
                    'amount' => '25000000',
                    'txt_amount' => 'ຊາວຫ້າລ້ານ',
                    'modified_by' => 1
                ]
            ],
        );
    }
}
