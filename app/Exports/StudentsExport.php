<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class StudentsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $major;
    private $generation;
    private $status;

    public function __construct($major, $generation, $status)
    {
        $this->major = $major;
        $this->generation = $generation;
        $this->status = $status;
    }

    public function collection()
    {
        $students = DB::table('students')
            ->select('users.id as id', 'students.student_id as student_id', 'users.fname_lo as fname_lo', 'users.lname_lo as lname_lo', 'majors.major as major', 'generations.gen as gen', 'students.status as status', 'users.created_at', 'users.updated_at')
            ->join('users', 'students.user_id', 'users.id')
            ->join('majors', 'students.major_id', 'majors.id')
            ->join('generations', 'students.gen_id', 'generations.id');

        if ($this->major) {
            $students->where('students.major_id', $this->major);
        }

        if ($this->generation) {
            $students->where('students.gen_id',  $this->generation);
        }

        if ($this->status) {
            $students->where('students.status', $this->status);
        }

        return $students->get();
    }

    public function headings(): array
    {
        return [
            'ລະຫັດບັນຊີຜູ້ໃຊ້',
            'ລະຫັດນັກສຶກສາ',
            'ຊື່',
            'ນາມສະກຸນ',
            'ສາຂາວິຊາ',
            'ຮຸ່ນການສຶກສາ',
            'ສະຖານະພາບການສຶກສາ',
            'ວັນທີສ້າງ',
            'ວັນທີແກ້ໄຂຫຼ້າສຸດ'
        ];
    }
}
