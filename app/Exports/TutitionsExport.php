<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;


class TutitionsExport implements FromCollection, WithHeadings
{
    private $major;
    private $gen;
    private $status;

    public function __construct($major, $gen, $status)
    {
        $this->major = $major;
        $this->gen = $gen;
        $this->status = $status;
    }

    public function collection()
    {

        $students = DB::table('tutitions')
            ->select('tutitions.id', 'students.student_id', DB::raw('CONCAT(users.fname_lo," ", users.lname_lo) as full_name'), 'majors.major', 'generations.gen', 'tutitions.status', 'tutitions.due_date', 'tutitions.created_at', 'tutitions.updated_at')
            ->join('students', 'tutitions.student_id', 'students.id')
            ->join('users', 'students.user_id', 'users.id')
            ->join('majors', 'tutitions.major_id', 'majors.id')
            ->join('generations', 'tutitions.gen_id', 'generations.id');

        if ($this->major) {
            $students->where('tutitions.major_id', $this->major);
        }
        if ($this->gen) {
            $students->where('tutitions.gen_id', $this->gen);
        }
        if ($this->status) {
            $students->where('tutitions.status', $this->status);
        }

        return $students->get();
    }

    public function headings(): array
    {
        return [
            'ລະຫັດຊຳລະ',
            'ລະຫັດນັກສຶກສາ',
            'ຊື່-ນາມສະກຸນ',
            'ສາຂາວິຊາ',
            'ຮຸ່ນການສຶກສາ',
            'ສະຖານະການຊຳລະ',
            'ວັນທີຊຳລະ',
            'ວັນທີສ້າງ',
            'ວັນທີແກ້ໄຂຫຼ້າສຸດ'
        ];
    }
}
