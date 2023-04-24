<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            //admin
            [
                'fname_lo' => 'ອາທິບພະກອນ',
                'lname_lo' => 'ເຊີນວິໄລ',
                'fname_en' => 'Athipphakone',
                'lname_en' => 'Xeunvilay',
                'username' => 'athipxeun',
                'email' => 'athipphakonex9595@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status' => 'active'
            ],
            //teacher
            // [
            //     'fname_lo' => 'ອຈ.ປອ. ນ ວິມົນທາ',
            //     'lname_lo' => 'ຂຽວວົງພະຈັນ',
            //     'fname_en' => 'Vimontha',
            //     'lname_en' => 'Khieovongphachanh',
            //     'username' => 'vimontha',
            //     'email' => 'vimontha@vimontha.com',
            //     'password' => Hash::make('admin123'),
            //     'role' => 'teacher',
            //     'status' => 'active'
            // ],
            //coordinator
            [
                'fname_lo' => 'ປທ. ນ ມະນິດດາ',
                'lname_lo' => 'ທະວົງຈິດ',
                'fname_en' => 'Manithda',
                'lname_en' => 'Thavongchid',
                'username' => 'manithda',
                'email' => 'manithda@manithda.com',
                'password' => Hash::make('admin123'),
                'role' => 'coordinator',
                'status' => 'active'
            ],
            //headUnit
            [
                'fname_lo' => 'ອຈ.ປອ. ຄຳເພັດ',
                'lname_lo' => 'ບຸນນະດີ',
                'fname_en' => 'Khamphet',
                'lname_en' => 'Bounnady',
                'username' => 'khamphet',
                'email' => 'khamphet@khamphet.com',
                'password' => Hash::make('admin123'),
                'role' => 'headUnit',
                'status' => 'active'
            ],
            //headDept
            [
                'fname_lo' => 'ຮສ.ປທ. ທາ',
                'lname_lo' => 'ບຸນທັນ',
                'fname_en' => 'Tha',
                'lname_en' => 'Bounthanh',
                'username' => 'tha',
                'email' => 'tha@tha.com',
                'password' => Hash::make('admin123'),
                'role' => 'headDept',
                'status' => 'active'
            ]
        ]);
    }
}
