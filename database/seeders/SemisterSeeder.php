<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('semisters')->insert([
            ['semister' => '1'],
            ['semister' => '2'],
            ['semister' => '3'],
            ['semister' => '4'],
        ]);
    }
}
