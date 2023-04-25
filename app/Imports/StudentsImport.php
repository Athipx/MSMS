<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\User;
use App\Models\Student;
use App\Models\Generation;
use App\Models\Major;
use Illuminate\Support\Facades\Hash;

class StudentsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        foreach ($collection as $row) {

            if ($row[7] == 'Software' || $row[7] == 'ວິສະວະກຳຊັອບແວ') {
                $major = Major::where('major', 'ວິສະວະກຳຊັອບແວ')->first();
                $row[7] = $major->id;
            } elseif ($row[7] == 'Network' || $row[7] == 'ລະບົບເຄືອຂ່າຍຄອມພິວເຕີ') {
                $major = Major::where('major', 'ລະບົບເຄືອຂ່າຍຄອມພິວເຕີ')->first();
                $row[7] = $major->id;
            }

            if ($row[8] == 'ຊາຍ') {
                $row[8] = 'male';
            } elseif ($row[8] == 'ຍິງ') {
                $row[8] = 'female';
            }

            if ($row[9] == 'ພະນັກງານເອກະຊົນ') {
                $row[9] = 'private';
            } elseif ($row[9] == 'ລັດຖະກອນ') {
                $row[9] = 'government';
            }

            if ($row[0] != 'ຊື່(ລາວ)') { // To skip header row

                $user = new User;
                $user->fname_lo = $row[0];
                $user->lname_lo = $row[1];
                $user->fname_en = $row[2];
                $user->lname_en = $row[3];
                $user->email = $row[4];
                $user->password = Hash::make($row[5]);
                $user->save();

                $student = new Student;
                $student->user_id = $user->id;
                $student->gen_id = $row[6];
                $student->major_id = $row[7];
                $student->gender = $row[8];
                $student->working_org = $row[9];
                $student->working_place = $row[10];
                $student->working_duration = $row[11];
                $student->bd_major = $row[12];
                $student->bd_academy = $row[13];
                $student->bd_grade = $row[14];
                $student->bd_graduated_year = $row[15];
                $student->save();
            }
        }
    }
}
