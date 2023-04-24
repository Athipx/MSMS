<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class FeesReport implements FromCollection, WithHeadings
{
    private $major;
    private $gen;
    private $feeType;
    private $status;

    public function __construct($major, $gen, $feeType, $status)
    {
        $this->major = $major;
        $this->gen = $gen;
        $this->feeType = $feeType;
        $this->status = $status;
    }

    public function collection()
    {

        $students = DB::table('student_fees')
            ->select('student_fees.id', 'fee_types.type as type', 'student_fees.status as status', 'student_fees.due_date as date', 'students.student_id as student_id', DB::raw('CONCAT(users.fname_lo," ", users.lname_lo) as full_name'),  'generations.gen as gen', 'majors.major as major', 'student_fees.created_at', 'student_fees.updated_at')
            ->join('students', 'student_fees.student_id', 'students.id')
            ->join('users', 'students.user_id', 'users.id')
            ->join('majors', 'student_fees.major_id', 'majors.id')
            ->join('generations', 'student_fees.gen_id', 'generations.id')
            ->join('fee_types', 'student_fees.fee_type_id', 'fee_types.id');


        if ($this->feeType) {
            $students->where('student_fees.fee_type_id', $this->feeType);
        }

        if ($this->major) {
            $students->Where('student_fees.major_id', $this->major);
        }

        if ($this->gen) {
            $students->Where('student_fees.gen_id', $this->gen);
        }

        if ($this->status) {
            $students->Where('student_fees.status', $this->status);
        }

        return $students->get();
    }

    public function headings(): array
    {
        return [
            'ລະຫັດ',
            'ປະເພດຄ່າທຳນຽມ',
            'ສະຖານະການຊຳລະ',
            'ວັນທີຊຳລະ',
            'ລະຫັດນັກສຶກສາ',
            'ຊື່-ນາມສະກຸນນັກສຶກສາ',
            'ຮຸ່ນການສຶກສາ',
            'ສາຂາວິຊາ',
            'ວັນທີສ້າງ',
            'ວັນທີແກ້ໄຂຫຼ້າສຸດ'
        ];
    }
}
