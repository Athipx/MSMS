<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Generation;
use App\Models\Major;
use App\Models\Subject;
use App\Models\Assign;
use App\Models\Student;
use App\Models\StudentGrade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\GradesExport;
use App\Exports\TcGradesExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class GradesReportController extends Controller
{
    public function GetSubjects(Request $request)
    {
        $major_id = $request->major_id;
        $gen_id = $request->gen_id;
        $allData = Assign::with('subject')
            ->where('major_id', $major_id)
            ->where('gen_id', $gen_id)
            ->get();
        return response()->json($allData);
    }

    public function GradesReport(Request $request)
    {
        $gens = Generation::orderBy('id', 'DESC')->get();
        $majors = Major::all();

        $major_id = $request->major_id;
        $gen_id = $request->gen_id;
        $subject = $request->subject_id;

        $grades = DB::table('student_grades')
            ->select('student_grades.id as id', 'subjects.subject as subject', 'students.student_id as student_id', 'generations.gen as gen', 'users.fname_lo as fname', 'users.lname_lo as lname', 'generations.gen as generation', 'majors.major as major', 'student_grades.grade as grade')
            ->join('students', 'student_grades.student_id', '=', 'students.id')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->join('assigns', 'student_grades.assign_id', '=', 'assigns.id')
            ->join('generations', 'assigns.gen_id', '=', 'generations.id')
            ->join('majors', 'assigns.major_id', '=', 'majors.id')
            ->join('subjects', 'assigns.subject_id', '=', 'subjects.id')
            ->where('student_grades.deleted', false)
            ->where('majors.id', $major_id)
            ->where('generations.id', $gen_id)
            ->where('assigns.id', $subject)
            ->get();

        $count = $grades->count();
        return view('reports.education_report.grades_report.grades_report', compact('count', 'grades', 'gens', 'majors', 'major_id', 'gen_id', 'subject'));
    }

    public function exportFilteredGrades(Request $request)
    {
        $major = $request->input('major_id');
        $generation = $request->input('gen_id');
        $subject = $request->input('subject_id');

        $date = Carbon::now()->format('d-m-Y-H-i-s');
        $filename = 'grades-' . $date . '.xlsx';

        // Export the data to Excel
        return Excel::download(new GradesExport($major, $generation, $subject), $filename);
    }

    public function TeacherGradesReport(Request $request)
    {
        $gens = Generation::orderBy('id', 'DESC')->get();
        $majors = Major::all();

        $major_id = $request->major_id;
        $gen_id = $request->gen_id;
        $subject = $request->subject_id;

        $grades = DB::table('student_grades')
            ->select('student_grades.id as id', 'subjects.subject as subject', 'students.student_id as student_id', 'generations.gen as gen', 'users.fname_lo as fname', 'users.lname_lo as lname', 'generations.gen as generation', 'majors.major as major', 'student_grades.grade as grade')
            ->join('students', 'student_grades.student_id', '=', 'students.id')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->join('assigns', 'student_grades.assign_id', '=', 'assigns.id')
            ->join('generations', 'assigns.gen_id', '=', 'generations.id')
            ->join('majors', 'assigns.major_id', '=', 'majors.id')
            ->join('subjects', 'assigns.subject_id', '=', 'subjects.id')
            ->where('student_grades.deleted', false)
            ->where('majors.id', $major_id)
            ->where('generations.id', $gen_id)
            ->where('assigns.id', $subject)
            ->get();

        $count = $grades->count();
        return view('teacher.reports.grades_report', compact('count', 'grades', 'gens', 'majors', 'major_id', 'gen_id', 'subject'));
    }

    public function TeacherExportFilteredGrades(Request $request)
    {
        $major = $request->input('major_id');
        $generation = $request->input('gen_id');
        $subject = $request->input('subject_id');

        $date = Carbon::now()->format('d-m-Y-H-i-s');
        $filename = 'grades-' . $date . '.xlsx';

        // Export the data to Excel
        return Excel::download(new TcGradesExport($major, $generation, $subject), $filename);
    }
}
