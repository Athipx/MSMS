<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class AssignsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $major;
    private $generation;
    private $semister;

    public function __construct($major, $generation, $semister)
    {
        $this->major = $major;
        $this->generation = $generation;
        $this->semister = $semister;
    }

    public function collection()
    {
        // Begin the query by selecting the necessary columns from the assigns table
        // and joining the related tables (subjects, generations, majors, semisters, classrooms, teacher_assigns, teachers, and users)
        $assigns = DB::table('assigns')
            ->select('assigns.id as id', 'subjects.subject as subject', 'generations.gen as gen', 'majors.major as major', 'semisters.semister as semister', 'classrooms.classroom as classroom', DB::raw('GROUP_CONCAT(users.fname_lo," ", users.lname_lo) as teacher_names'), 'assigns.created_at as created_at', 'assigns.updated_at as updated_at')
            ->join('subjects', 'assigns.subject_id', 'subjects.id')
            ->join('generations', 'assigns.gen_id', 'generations.id')
            ->join('majors', 'assigns.major_id', 'majors.id')
            ->join('semisters', 'assigns.semister_id', 'semisters.id')
            ->join('classrooms', 'assigns.classroom_id', 'classrooms.id')
            ->join('teacher_assigns', 'assigns.id', '=', 'teacher_assigns.assign_id')
            ->join('teachers', 'teachers.id', '=', 'teacher_assigns.teacher_id')
            ->join('users', 'users.id', '=', 'teachers.user_id');

        // Apply filters based on the selected major, generation, and semister (if any)
        if ($this->major) {
            $assigns->where('assigns.major_id', $this->major);
        }

        if ($this->generation) {
            $assigns->where('assigns.gen_id', $this->generation);
        }

        if ($this->semister) {
            $assigns->where('assigns.semister_id', $this->semister);
        }

        // Group the results by the selected columns (except for teacher_names) to concatenate the teacher names correctly
        $assigns = $assigns->groupBy('assigns.id', 'subjects.subject', 'generations.gen', 'majors.major', 'semisters.semister', 'classrooms.classroom', 'assigns.created_at', 'assigns.updated_at')->get();

        // Map the results to the desired format for exporting to Excel
        $data = $assigns->map(function ($assign) {
            return [
                $assign->id,
                $assign->subject,
                $assign->gen,
                $assign->major,
                $assign->semister,
                $assign->classroom,
                $assign->teacher_names, // Teacher names are already concatenated in the query
                $assign->created_at,
                $assign->updated_at,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'ລະຫັດການຮຽນ-ການສອນ',
            'ວິຊາຮຽນ',
            'ຮຸ່ນການສຶກສາ',
            'ສາຂາວິຊາ',
            'ພາກການສຶກສາ',
            'ຫ້ອງຮຽນ',
            'ອາຈານສອນ',
            'ວັນທີສ້າງ',
            'ວັນທີແກ້ໄຂຫຼ້າສຸດ'
        ];
    }
}
