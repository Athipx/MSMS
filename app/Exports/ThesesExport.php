<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;


class ThesesExport implements FromCollection, WithHeadings
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
        $theses = DB::table('theses')
            ->select('theses.id', 'theses.title_lo', 'theses.title_en', 'students.student_id', DB::raw('CONCAT(users.fname_lo, " ", users.lname_lo) as full_name'), 'majors.major', 'generations.gen', 'theses.status', 'theses.created_at', 'theses.updated_at')
            ->join('students', 'theses.student_id', 'students.id')
            ->join('users', 'students.user_id', 'users.id')
            ->join('majors', 'theses.major_id', 'majors.id')
            ->join('generations', 'theses.gen_id', 'generations.id');

        if ($this->major) {
            $theses->where('theses.major_id', $this->major);
        }
        if ($this->gen) {
            $theses->where('theses.gen_id', $this->gen);
        }
        if ($this->status) {
            $theses->where('theses.status', $this->status);
        }

        return $theses->get();
    }

    public function headings(): array
    {
        return [
            'ລະຫັດວິທະຍານິພົນ',
            'ຊື່ຫົວບົດວິທະຍານິພົນ (ລາວ)',
            'ຊື່ຫົວບົດວິທະຍານິພົນ (English)',
            'ລະຫັດນັກສຶກສາ',
            'ຊື່-ນາມສະກຸນນັກສຶກສາ',
            'ສາຂາວິຊາ',
            'ຮຸ່ນການສຶກສາ',
            'ສະຖານະບົດວິທະຍານິພົນ',
            'ວັນທີສ້າງ',
            'ວັນທີແກ້ຫຼ້າສຸດ'
        ];
    }
}
