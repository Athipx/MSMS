<?php

namespace App\Exports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class TeachersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $major;

    public function __construct($major)
    {
        $this->major = $major;
    }

    public function collection()
    {
        $teachers = DB::table('teachers')
            ->select('users.id as id', 'users.fname_lo as fname_lo', 'users.lname_lo as lname_lo', 'majors.major as major', 'users.created_at', 'users.updated_at')
            ->join('users', 'teachers.user_id', 'users.id')
            ->join('majors', 'teachers.major_id', 'majors.id');

        if ($this->major) {
            $teachers->where('teachers.major_id', $this->major);
        }

        return $teachers->get();
    }

    public function headings(): array
    {
        return [
            'ລະຫັດບັນຊີຜູ້ໃຊ້',
            'ຊື່',
            'ນາມສະກຸນ',
            'ສາຂາວິຊາ',
            'ວັນທີສ້າງ',
            'ວັນທີແກ້ຫຼ້າສຸດ'
        ];
    }
}
