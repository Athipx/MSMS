<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('students')->insert([
        //     [
        //         'user_id' => 2,
        //         'student_id' => '227N0029/21',
        //         'gen_id' => '10',
        //         'major_id' => '1',
        //         'gender' => 'male',
        //     ],
        //     [
        //         'user_id' => 3,
        //         'student_id' => '227N0023/21',
        //         'gen_id' => '10',
        //         'major_id' => '1',
        //         'gender' => 'male',
        //     ],
        // ]);
    }
}
