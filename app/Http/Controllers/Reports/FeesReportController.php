<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\FeeType;
use App\Models\Generation;
use App\Models\Major;
use App\Models\Student;
use App\Models\StudentFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\FeesReport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class FeesReportController extends Controller
{
    public function FeesReport(Request $request)
    {
        $feeTypes = FeeType::all();
        $majors = Major::all();
        $gens = Generation::orderBy('id', 'DESC')->get();

        $major_id = $request->major_id;
        $feeType_id = $request->feeType;
        $gen_id = $request->gen_id;
        $status = $request->status;

        $students = DB::table('student_fees')
            ->select('users.fname_lo as fname', 'student_fees.due_date as date', 'fee_types.type as type', 'users.lname_lo as lname', 'generations.gen as gen', 'majors.major as major', 'student_fees.status as status', 'students.student_id as student_id', 'students.id as id')
            ->join('students', 'student_fees.student_id', 'students.id')
            ->join('users', 'students.user_id', 'users.id')
            ->join('majors', 'student_fees.major_id', 'majors.id')
            ->join('generations', 'student_fees.gen_id', 'generations.id')
            ->join('fee_types', 'student_fees.fee_type_id', 'fee_types.id');


        if ($feeType_id) {
            $students->where('student_fees.fee_type_id', $feeType_id);
        }

        if ($major_id) {
            $students->Where('student_fees.major_id', $major_id);
        }

        if ($gen_id) {
            $students->Where('student_fees.gen_id', $gen_id);
        }

        if ($status) {
            $students->Where('student_fees.status', $status);
        }
        $students = $students->get();

        $count = $students->count();

        return view('reports.fees_report.fees_report', compact('count', 'feeTypes', 'majors', 'gens', 'students', 'major_id', 'feeType_id', 'gen_id', 'status'));
    }

    public function exportFilteredFees(Request $request)
    {
        $major = $request->major_id;
        $feeType = $request->feeType;
        $gen = $request->gen_id;
        $status = $request->status;

        $date = Carbon::now()->format('d-m-Y-H-i-s');
        $filename = 'fees-' . $date . '.xlsx';

        // Export the data to Excel
        return Excel::download(new FeesReport($major, $gen, $feeType, $status), $filename);
    }
}
