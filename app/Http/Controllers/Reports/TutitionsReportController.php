<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\Generation;
use App\Models\Student;
use App\Models\Tutition;
use App\Models\FeeType;
use App\Models\TutitionInstallment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exports\TutitionsExport;
use Maatwebsite\Excel\Facades\Excel;


class TutitionsReportController extends Controller
{
    public function TutitionsReport(Request $request)
    {
        $majors = Major::where('deleted', false)->get();
        $gens = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();

        $major_id = $request->major_id;
        $gen_id = $request->gen_id;
        $status = $request->status;

        $data = DB::table('tutitions')
            ->select('tutitions.id', 'students.student_id', DB::raw('CONCAT(users.fname_lo," ", users.lname_lo) as full_name'), 'majors.major', 'generations.gen', 'tutitions.status', 'tutitions.due_date')
            ->join('students', 'tutitions.student_id', 'students.id')
            ->join('users', 'students.user_id', 'users.id')
            ->join('majors', 'tutitions.major_id', 'majors.id')
            ->join('generations', 'tutitions.gen_id', 'generations.id');

        if ($major_id) {
            $data->where('tutitions.major_id', $major_id);
        }
        if ($gen_id) {
            $data->where('tutitions.gen_id', $gen_id);
        }
        if ($status) {
            $data->where('tutitions.status', $status);
        }

        $data = $data->get();
        $count = $data->count();

        return view('reports.fees_report.tutitions_report', compact('count', 'data', 'majors', 'gens', 'major_id', 'gen_id', 'status'));
    }

    public function exportFilteredTutitions(Request $request)
    {
        $major = $request->major_id;
        $gen = $request->gen_id;
        $status = $request->status;

        $date = Carbon::now()->format('d-m-Y-H-i-s');
        $filename = 'tutition-' . $date . '.xlsx';

        // Export the data to Excel
        return Excel::download(new TutitionsExport($major, $gen, $status), $filename);
    }
}
