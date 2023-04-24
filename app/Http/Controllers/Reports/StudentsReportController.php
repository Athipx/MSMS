<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Generation;
use App\Models\Major;
use Illuminate\Support\Facades\DB;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class StudentsReportController extends Controller
{
    public function StudentsReport(Request $request)
    {
        $majors = Major::all();
        $gens = Generation::orderBy('id', 'DESC')->get();

        $major_id = $request->major_id;
        $gen_id = $request->gen_id;
        $student_status = $request->student_status;

        $students = DB::table('students')
            ->select('users.id as id', 'students.student_id as student_id', 'users.fname_lo as fname_lo', 'users.lname_lo as lname_lo', 'majors.major as major', 'generations.gen as gen', 'students.status as status', 'users.created_at', 'users.updated_at')
            ->join('users', 'students.user_id', 'users.id')
            ->join('majors', 'students.major_id', 'majors.id')
            ->join('generations', 'students.gen_id', 'generations.id');

        if ($major_id) {
            $students->where('students.major_id', $major_id);
        }

        if ($gen_id) {
            $students->where('students.gen_id',  $gen_id);
        }

        if ($student_status) {
            $students->where('students.status', $student_status);
        }

        $students = $students->get();

        $count = $students->count();

        return view('reports.users_report.students_report.students_report', compact('students', 'majors', 'gens', 'major_id', 'gen_id', 'student_status', 'count'));
    }

    public function exportFilteredStudents(Request $request)
    {
        $major = $request->input('major_id');
        $generation = $request->input('gen_id');
        $status = $request->input('student_status');

        $date = Carbon::now()->format('d-m-Y-H-i-s');
        $filename = 'students-' . $date . '.xlsx';

        // Export the data to Excel
        return Excel::download(new StudentsExport($major, $generation, $status), $filename);
    }
}
