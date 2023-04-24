<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thesis;
use App\Models\Major;
use App\Models\Generation;
use Illuminate\Support\Facades\DB;
use App\Exports\ThesesExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ThesesReportController extends Controller
{
    public function ThesesReport(Request $request)
    {
        $majors = Major::where('deleted', false)->get();
        $gens = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();

        $major_id = $request->major_id;
        $gen_id = $request->gen_id;
        $status = $request->status;

        $theses = DB::table('theses')
            ->select('theses.title_lo', 'theses.title_en', 'students.student_id', DB::raw('CONCAT(users.fname_lo, " ", users.lname_lo) as full_name'), 'majors.major', 'generations.gen', 'theses.status')
            ->join('students', 'theses.student_id', 'students.id')
            ->join('users', 'students.user_id', 'users.id')
            ->join('majors', 'theses.major_id', 'majors.id')
            ->join('generations', 'theses.gen_id', 'generations.id');

        if ($major_id) {
            $theses->where('theses.major_id', $major_id);
        }
        if ($gen_id) {
            $theses->where('theses.gen_id', $gen_id);
        }
        if ($status) {
            $theses->where('theses.status', $status);
        }

        $theses = $theses->get();
        $count = $theses->count();

        return view('reports.theses_report.theses_report', compact('count', 'theses', 'majors', 'gens', 'major_id', 'gen_id', 'status'));
    }

    public function exportFilteredTheses(Request $request)
    {
        $major = $request->input('major_id');
        $gen = $request->input('gen_id');
        $status = $request->input('status');

        $date = Carbon::now()->format('d-m-Y-H-i-s');
        $filename = 'theses-' . $date . '.xlsx';

        // Export the data to Excel
        return Excel::download(new ThesesExport($major, $gen, $status), $filename);
    }
}
