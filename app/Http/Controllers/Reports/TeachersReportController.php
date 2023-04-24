<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Major;
use Illuminate\Support\Facades\DB;
use App\Exports\TeachersExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class TeachersReportController extends Controller
{
    public function TeachersReport(Request $request)
    {
        $majors = Major::all();

        $major_id = $request->major_id;

        $teachers = DB::table('teachers')
            ->select('users.id as id', 'users.fname_lo as fname_lo', 'users.lname_lo as lname_lo', 'majors.major as major', 'users.created_at', 'users.updated_at')
            ->join('users', 'teachers.user_id', 'users.id')
            ->join('majors', 'teachers.major_id', 'majors.id');

        if ($major_id) {
            $teachers->where('teachers.major_id', $major_id);
        }

        $teachers = $teachers->get();

        $count = $teachers->count();

        return view('reports.users_report.teachers_report.teachers_report', compact('teachers', 'majors', 'major_id', 'count'));
    }

    public function exportFilteredTeachers(Request $request)
    {
        $major = $request->input('major_id');

        $date = Carbon::now()->format('d-m-Y-H-i-s');
        $filename = 'teachers-' . $date . '.xlsx';

        // Export the data to Excel
        return Excel::download(new TeachersExport($major), $filename);
    }
}
