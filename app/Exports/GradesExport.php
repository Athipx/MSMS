<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class GradesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $major;
    private $generation;
    private $subject;

    public function __construct($major, $generation, $subject)
    {
        $this->major = $major;
        $this->generation = $generation;
        $this->subject = $subject;
    }

    public function collection()
    {
        return DB::table('student_grades')
            ->select('student_grades.id as id', 'students.student_id as student_id', DB::raw('CONCAT(users.fname_lo," ", users.lname_lo) AS full_name'), 'generations.gen as generation', 'majors.major as major', 'subjects.subject as subject', 'student_grades.grade as grade', 'student_grades.old_grade as old_grade', 'student_grades.upgrade_date as upgrade_date', 'student_grades.description', 'student_grades.created_at', 'student_grades.updated_at')
            ->join('students', 'student_grades.student_id', '=', 'students.id')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->join('assigns', 'student_grades.assign_id', '=', 'assigns.id')
            ->join('generations', 'assigns.gen_id', '=', 'generations.id')
            ->join('majors', 'assigns.major_id', '=', 'majors.id')
            ->join('subjects', 'assigns.subject_id', '=', 'subjects.id')
            ->where('student_grades.deleted', false)
            ->where('majors.id',  $this->major)
            ->where('generations.id', $this->generation)
            ->where('assigns.id', $this->subject)
            ->get();
    }

    public function headings(): array
    {
        return [
            'ລະຫັດ',
            'ລະຫັດນັກສຶກສາ',
            'ຊື່-ນາມສະກຸນນັກສຶກສາ',
            'ຮຸ່ນການສຶກສາ',
            'ສາຂາວິຊາ',
            'ວິຊາຮຽນ',
            'ເກຣດ',
            'ເກຣດເກົ່າ',
            'ວັນທີອັບເກຣດ',
            'ລາຍລະອຽດ',
            'ວັນທີສ້າງ',
            'ວັນທີແກ້ໄຂຫຼ້າສຸດ'
        ];
    }
}
