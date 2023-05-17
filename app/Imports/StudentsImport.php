<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\User;
use App\Models\Student;
use App\Models\Generation;
use App\Models\Major;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToCollection
{
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

            if ($row[10] == 'ເອກະຊົນ') {
                $row[10] = 'private';
            } elseif ($row[10] == 'ລັດ') {
                $row[10] = 'government';
            }

            if ($row[0] != 'ຊື່(ລາວ)') { // To skip header row

                // Check if user with email already exists
                $existingUser = User::where('email', $row[4])->first();
                if ($existingUser) {
                    continue; // Skip creating student record
                }

                // Validate email format
                $validatedData = Validator::make(['email' => $row[4]], [
                    'email' => 'required|email|unique:users'
                ])->validate();

                $user = new User;
                $user->fname_lo = $row[0];
                $user->lname_lo = $row[1];
                $user->fname_en = $row[2];
                $user->lname_en = $row[3];
                $user->email = $row[4];
                $user->password = bcrypt($row[5]);
                $user->phone = $row[9];
                $user->status = 'active';
                $user->save();

                $student = new Student;
                $student->user_id = $user->id;
                $student->gen_id = $row[6];
                $student->major_id = $row[7];
                $student->gender = $row[8];
                $student->working_org = $row[10];
                $student->working_place = $row[11];
                $student->working_duration = $row[12];
                $student->bd_major = $row[13];
                $student->bd_academy = $row[14];
                $student->bd_grade = $row[15];
                $student->bd_graduated_year = $row[16];
                $student->save();
            }
        }
    }
}


// class StudentsImport implements ToCollection, WithHeadingRow
// {
//     public function collection(Collection $collection)
//     {
//         Validator::make($collection->toArray(), [
//             '*.email' => 'required|unique:users,email',
//         ], [
//             '*.email.required' => 'ກະລຸນາປ້ອນອີເມວ',
//             '*.email.unique' => 'ມີອີເມວນີ້ໃນລະບົບແລ້ວ',
//         ])->validate();

//         foreach ($collection as $row) {

//             if ($row['ສາຂາ'] == 'Software' || $row['ສາຂາ'] == 'ວິສະວະກຳຊັອບແວ') {
//                 $major = Major::where('major', 'ວິສະວະກຳຊັອບແວ')->first();
//                 $row['ສາຂາ'] = $major->id;
//             } elseif ($row['ສາຂາ'] == 'Network' || $row['ສາຂາ'] == 'ລະບົບເຄືອຂ່າຍຄອມພິວເຕີ') {
//                 $major = Major::where('major', 'ລະບົບເຄືອຂ່າຍຄອມພິວເຕີ')->first();
//                 $row['ສາຂາ'] = $major->id;
//             }

//             if ($row['ເພດ'] == 'ຊາຍ') {
//                 $row['ເພດ'] = 'male';
//             } elseif ($row['ເພດ'] == 'ຍິງ') {
//                 $row['ເພດ'] = 'female';
//             }

//             if ($row['ອົງກອນ'] == 'ພະນັກງານເອກະຊົນ') {
//                 $row['ອົງກອນ'] = 'private';
//             } elseif ($row['ອົງກອນ'] == 'ລັດຖະກອນ') {
//                 $row['ອົງກອນ'] = 'government';
//             }

//             if ($row['ຊື່ (ລາວ)'] != 'ຊື່ (ລາວ)') { // To skip header row

//                 $user = new User;
//                 $user->fname_lo = $row['ຊື່ (ລາວ)'];
//                 $user->lname_lo = $row['ນາມສະກຸນ (ລາວ)'];
//                 $user->fname_en = $row['ຊື່ (ອັງກິດ)'];
//                 $user->lname_en = $row['ນາມສະກຸນ (ອັງກິດ)'];
//                 $user->email = $row['email'];
//                 $user->password = Hash::make($row['ລະຫັດຜ່ານ']);
//                 $user->save();

//                 $student = new Student;
//                 $student->user_id = $user->id;
//                 $student->gen_id = $row['ຮຸ່ນການສຶກສາ'];
//                 $student->major_id = $row['ສາຂາ'];
//                 $student->gender = $row['ເພດ'];
//                 $student->working_org = $row['ອົງກອນ'];
//                 $student->working_place = $row['ມາຈາກພາກສ່ວນ'];
//                 $student->working_duration = $row['ປີການ'];
//                 $student->bd_major = $row['ສາຂາທີ່ຈົບ'];
//                 $student->bd_academy = $row['ຈົບຈາກ'];
//                 $student->bd_grade = $row['ຄະແນນສະເລ່ຍ'];
//                 $student->bd_graduated_year = $row['ສົກຮຽນທີ່ຈົບ'];
//                 $student->save();
//             }
//         }
//     }
// }
