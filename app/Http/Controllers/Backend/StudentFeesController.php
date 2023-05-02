<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FeeType;
use App\Models\Generation;
use App\Models\Major;
use App\Models\Student;
use App\Models\StudentFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentFeesController extends Controller
{

    public function StudentFeesView(Request $request)
    {
        $feeTypes = FeeType::where('type', '<>', 'ຄ່າຮຽນ')->get();
        $majors = Major::all();
        $gens = Generation::orderBy('id', 'DESC')->get();

        $major_id = $request->major_id;
        $feeType_id = $request->feeType;
        $gen_id = $request->gen_id;
        $status = $request->status;

        $students = DB::table('student_fees')
            ->select('student_fees.id as stdfeeId', 'users.fname_lo as fname', 'student_fees.due_date as date', 'fee_types.type as type', 'users.lname_lo as lname', 'generations.gen as gen', 'majors.major as major', 'student_fees.status as status', 'students.student_id as student_id', 'students.id as id')
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

        return view('management.fees.fee_view', compact('feeTypes', 'majors', 'gens', 'students', 'major_id', 'feeType_id', 'gen_id', 'status'));
    }

    public function StudentFeesAdd()
    {
        $feeTypes = FeeType::where('type', '<>', 'ຄ່າຮຽນ')->get();
        $majors = Major::where('deleted', false)->get();
        $gens = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();
        return view('management.fees.fee_add', compact('feeTypes', 'majors', 'gens'));
    }

    public function getStudents(Request $request)
    {
        $gens = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();
        $majors = Major::where('deleted', false)->get();

        $major = $request->major_id;
        $gen = $request->gen_id;
        $feeType_id = $request->feeType_id;

        $allData = Student::with('user', 'major', 'gen')
            ->where('major_id', $major)
            ->where('gen_id', $gen)
            ->whereNotIn('status', ['graduated', 'drop', 'quit'])
            ->get();

        foreach ($allData as $data) {
            $countFee = StudentFee::where('student_id', $data->id)
                ->where('fee_type_id', $feeType_id)
                ->count();
            if ($countFee == 0) {
                StudentFee::create([
                    'student_id' => $data->id,
                    'major_id' => $data->major_id,
                    'gen_id' => $data->gen_id,
                    'fee_type_id' => $feeType_id,
                    'status' => 'unpaid',
                    'modified_by' => Auth::user()->id
                ]);
            }
        }

        $students = DB::table('student_fees')
            ->select('users.fname_lo as fname', 'student_fees.due_date as date', 'fee_types.type as type', 'users.lname_lo as lname', 'generations.gen as gen', 'majors.major as major', 'student_fees.status as status', 'students.student_id as student_id', 'students.id as id')
            ->join('students', 'student_fees.student_id', 'students.id')
            ->join('users', 'students.user_id', 'users.id')
            ->join('majors', 'student_fees.major_id', 'majors.id')
            ->join('generations', 'student_fees.gen_id', 'generations.id')
            ->join('fee_types', 'student_fees.fee_type_id', 'fee_types.id')
            ->where('student_fees.fee_type_id', $feeType_id)
            ->where('student_fees.major_id', $major)
            ->where('student_fees.gen_id', $gen)
            ->get();

        return view('management.fees.fee_filterResult', compact('students'));
    }

    public function FeesStore(Request $request)
    {
        // dd($request->all());

        $studentCount = $request->student_id;

        if ($studentCount) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $data = StudentFee::where('fee_type_id', $request->feeType_id)
                    ->where('student_id', $request->student_id[$i])
                    ->first();
                if ($data) {
                    $data->status = $request->status[$i];
                    $data->due_date = $request->due_date[$i] ? date('Y-m-d', strtotime($request->due_date[$i])) : null;
                    $data->modified_by = Auth::user()->id;
                    $data->save();
                    // dd($request->all());
                }
            }
        }

        $notification = array(
            'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function FeeDetail($id)
    {
        $data = StudentFee::find($id);
        return view('management.fees.fee_detail', compact('data'));
    }

    public function FeeEdit($id)
    {
        $editData = StudentFee::find($id);
        return view('management.fees.fee_edit', compact('editData'));
    }

    public function FeeUpdate(Request $request, $id)
    {

        $request->validate(
            [
                'due_date' => 'required'
            ],
            [
                'due_date.required' => 'ກະລຸນາລະບຸວັນທີຊຳລະ'
            ]
        );

        // dd($request->all());
        $data = StudentFee::find($id);
        $data->status = $request->status;
        $data->due_date = $request->due_date;
        $data->modified_by = Auth::user()->id;
        $data->save();

        $notification = array(
            'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
