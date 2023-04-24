<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('generations')->insert([
            //admin
            [
                'gen' => '1',
            ],
            [
                'gen' => '2',
            ],
            [
                'gen' => '3',
            ],
            [
                'gen' => '4',
            ],
            [
                'gen' => '5',
            ],
            [
                'gen' => '6',
            ],
            [
                'gen' => '7',
            ],
            [
                'gen' => '8',
            ],
            [
                'gen' => '9',
            ],
            [
                'gen' => '10',
            ],
            [
                'gen' => '11',
            ],
        ]);
    }
}
