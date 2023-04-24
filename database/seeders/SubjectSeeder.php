<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subjects')->insert([
            [
                'subject_id' => '380SD111',
                'subject' => 'ແນວທາງການດຳເນີນການຊັອບແວແບບສ່ວນບຸກຄົນ ແລະ ການດຳເນີນງານແບບເປັນທີມ',
                'credit' => '2',
            ],
            [
                'subject_id' => '380SQ114',
                'subject' => 'ພື້ນຖານພາສາ SQL',
                'credit' => '2',
            ],
            [
                'subject_id' => '380LA112',
                'subject' => 'ການພັດທະນາເວັບໄຊ ໂດຍໃຊ້ LAMP',
                'credit' => '5',
            ],
            [
                'subject_id' => '380IS115',
                'subject' => 'ຄວາມປອດໄພໃນລະບົບໄອທີ',
                'credit' => '2',
            ],
            [
                'subject_id' => '380JV113',
                'subject' => 'ພາສາ Java 1',
                'credit' => '3',
            ],
            [
                'subject_id' => '380DA121',
                'subject' => 'ການບໍລິຫານລະບົບຖານຂໍ້ມູນ 1',
                'credit' => '2',
            ],
            [
                'subject_id' => '380FW131',
                'subject' => 'ວຽກລົງເລິກຕົວຈິງສຳລັບນັກພັດທະນາຊັອບແວ 1',
                'credit' => '2',
            ],
            [
                'subject_id' => '380TD116',
                'subject' => 'ເຕັກນິກການຂຽນບົດລາຍງານ 1 (ພາສາອັງກິດ)',
                'credit' => '2',
            ],
            [
                'subject_id' => '380SP211',
                'subject' => 'ເທັກນິກການພັດທະນາຊັອບແວ ແລະ ການຈັດການໂຄງການ',
                'credit' => '2',
            ],
            [
                'subject_id' => '380DA222',
                'subject' => 'ການບໍລິຫານລະບົບຖານຂໍ້ມູນ 2',
                'credit' => '3',
            ],
            [
                'subject_id' => '380CC213',
                'subject' => 'ສະພາບແວດລ້ອມການຄ້າແບບຄະລາວຄອມພູດຕີງ',
                'credit' => '2',
            ],
            [
                'subject_id' => '380JV212',
                'subject' => 'ພາສາ Java II',
                'credit' => '3',
            ],
            [
                'subject_id' => '80FW232',
                'subject' => 'ວຽກລົງເລິກຕົວຈິງສຳລັບນັກພັດທະນາຊັອບແວ 2',
                'credit' => '1',
            ],
            [
                'subject_id' => '80FW214',
                'subject' => 'ຕັກນິກການຂຽນບົດລາຍງານ 2 (ພາສາອັງກິດ)',
                'credit' => '2',
            ],
            [
                'subject_id' => '80EM215',
                'subject' => 'ການບໍລິຫານກິດຈະການຂະໜາດນ້ອຍ ແລະ ກາງ',
                'credit' => '2',
            ],
            [
                'subject_id' => '380JV216',
                'subject' => 'ພາສາ Java III',
                'credit' => '3',
            ],
        ]);
    }
}
