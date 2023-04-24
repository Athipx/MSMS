<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Generation;
use App\Models\Major;
use App\Models\Semister;
use App\Models\Assign;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\AssignsExport;
use App\Exports\TcAssignsExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class AssignsReportController extends Controller
{
    public function AssignsReport(Request $request)
    {
        $majors = Major::where('deleted', false)->get();
        $gens = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();
        $semisters = Semister::where('deleted', false)->get();

        $major_id = $request->major_id;
        $gen_id = $request->gen_id;
        $semister_id = $request->semister_id;

        $data = DB::table('assigns')
            ->select('assigns.id as id', 'subjects.subject as subject', 'generations.gen as gen', 'majors.major as major', 'semisters.semister as semister', 'classrooms.classroom as classroom')
            ->join('subjects', 'assigns.subject_id', 'subjects.id')
            ->join('generations', 'assigns.gen_id', 'generations.id')
            ->join('majors', 'assigns.major_id', 'majors.id')
            ->join('semisters', 'assigns.semister_id', 'semisters.id')
            ->join('classrooms', 'assigns.classroom_id', 'classrooms.id');

        if ($major_id) {
            $data->where('major_id', $major_id);
        }

        if ($gen_id) {
            $data->where('gen_id', $gen_id);
        }

        if ($semister_id) {
            $data->where('semister_id', $semister_id);
        }

        $data = $data->get();
        $count = $data->count();

        foreach ($data as $assign) {
            $teachers = DB::table('teacher_assigns')
                ->select('users.fname_lo', 'users.lname_lo')
                ->join('teachers', 'teacher_assigns.teacher_id', 'teachers.id')
                ->join('users', 'teachers.user_id', 'users.id')
                ->where('teacher_assigns.assign_id', $assign->id)
                ->get();

            $assign->teachers = $teachers;
        }
        return view('reports.education_report.assigns_report.assigns_report', compact('data', 'count', 'semisters', 'majors', 'gens', 'major_id', 'gen_id', 'semister_id'));
    }

    public function exportFilteredAssigns(Request $request)
    {
        $major = $request->input('major_id');
        $generation = $request->input('gen_id');
        $semister = $request->input('semister_id');

        $date = Carbon::now()->format('d-m-Y-H-i-s');
        $filename = 'assigns-' . $date . '.xlsx';

        // Export the data to Excel
        return Excel::download(new AssignsExport($major, $generation, $semister), $filename);
    }

    public function TeacherAssignsReport(Request $request)
    {
        $majors = Major::where('deleted', false)->get();
        $gens = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();
        $semisters = Semister::where('deleted', false)->get();

        $major_id = $request->major_id;
        $gen_id = $request->gen_id;
        $semister_id = $request->semister_id;

        $user_id = $user_id = Auth::user()->id;
        $teacher_id = Teacher::where('user_id', $user_id)->first();

        $data = DB::table('assigns')
            ->select('assigns.id as id', 'subjects.subject as subject', 'generations.gen as gen', 'majors.major as major', 'semisters.semister as semister', 'classrooms.classroom as classroom')
            ->join('teacher_assigns', 'assigns.id', 'teacher_assigns.assign_id')
            ->join('subjects', 'assigns.subject_id', 'subjects.id')
            ->join('generations', 'assigns.gen_id', 'generations.id')
            ->join('majors', 'assigns.major_id', 'majors.id')
            ->join('semisters', 'assigns.semister_id', 'semisters.id')
            ->join('classrooms', 'assigns.classroom_id', 'classrooms.id')
            ->where('teacher_assigns.teacher_id', $teacher_id->id);

        if ($major_id) {
            $data->where('major_id', $major_id);
        }

        if ($gen_id) {
            $data->where('gen_id', $gen_id);
        }

        if ($semister_id) {
            $data->where('semister_id', $semister_id);
        }

        $data = $data->get();
        $count = $data->count();

        foreach ($data as $assign) {
            $teachers = DB::table('teacher_assigns')
                ->select('users.fname_lo', 'users.lname_lo')
                ->join('teachers', 'teacher_assigns.teacher_id', 'teachers.id')
                ->join('users', 'teachers.user_id', 'users.id')
                ->where('teacher_assigns.assign_id', $assign->id)
                ->get();

            $assign->teachers = $teachers;
        }
        return view('teacher.reports.assigns_report', compact('data', 'count', 'semisters', 'majors', 'gens', 'major_id', 'gen_id', 'semister_id'));
    }

    public function TeacherExportFilteredAssigns(Request $request)
    {
        $major = $request->input('major_id');
        $generation = $request->input('gen_id');
        $semister = $request->input('semister_id');

        $date = Carbon::now()->format('d-m-Y-H-i-s');
        $filename = 'assigns-' . $date . '.xlsx';

        // Export the data to Excel
        return Excel::download(new TcAssignsExport($major, $generation, $semister), $filename);
    }
}
