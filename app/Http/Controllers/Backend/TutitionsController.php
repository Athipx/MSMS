<?php

namespace App\Http\Controllers\Backend;

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

class TutitionsController extends Controller
{
    public function TutitionsView(Request $request)
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

        return view('management.tutitions.tutitions_view', compact('data', 'majors', 'gens', 'major_id', 'gen_id', 'status'));
    }

    public function TutitionsAdd()
    {
        $majors = Major::all();
        $gens = Generation::orderBy('id', 'DESC')->get();
        $feeType_id = DB::table('fee_types')
            ->select('fee_types.id')
            ->where('type', 'ຄ່າຮຽນ')
            ->get();

        // $feeType_id = FeeType::where('type', 'ຄ່າຮຽນ')->get();

        return view('management.tutitions.tutitions_add', compact('majors', 'gens', 'feeType_id'));
    }

    public function getStudents(Request $request)
    {
        $gens = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();
        $majors = Major::where('deleted', false)->get();

        $major = $request->major_id;
        $gen = $request->gen_id;

        $allData = Student::with('user', 'major', 'gen')
            ->where('major_id', $major)
            ->where('gen_id', $gen)
            ->whereNotIn('status', ['graduated', 'drop', 'quit'])
            ->get();

        $feeType_id = DB::table('fee_types')
            ->select('fee_types.id')
            ->where('type', 'ຄ່າຮຽນ')
            ->first(); // Use the first() method to get the first item in the collection

        foreach ($allData as $data) {
            $count = Tutition::where('student_id', $data->id)->count();
            if ($count == 0) {
                // Tutition::create([
                //     'student_id' => $data->id,
                //     'major_id' => $data->major_id,
                //     'gen_id' => $data->gen_id,
                //     'fee_type_id' => $feeType_id,
                //     'status' => 'unpaid',
                //     'modified_by' => Auth::user()->id
                // ]);
                $student = new Tutition;
                $student->student_id = $data->id;
                $student->major_id = $data->major_id;
                $student->gen_id = $data->gen_id;
                $student->fee_type_id = $feeType_id->id; // Assign the ID of the first item to the fee_type_id field
                $student->status = 'unpaid';
                $student->modified_by = Auth::user()->id;
                $student->save();
            }
        }

        $students = DB::table('tutitions')
            ->select('students.student_id', DB::raw('CONCAT(users.fname_lo," ", users.lname_lo) as full_name'), 'majors.major', 'generations.gen', 'tutitions.status', 'tutitions.due_date as date', 'students.id as id')
            ->join('students', 'tutitions.student_id', 'students.id')
            ->join('users', 'students.user_id', 'users.id')
            ->join('majors', 'tutitions.major_id', 'majors.id')
            ->join('generations', 'tutitions.gen_id', 'generations.id')
            ->where('tutitions.major_id', $major)
            ->where('tutitions.gen_id', $gen)
            ->orderBy('tutitions.id', 'DESC')
            ->get();

        return view('management.tutitions.tutiton_filterResult', compact('students'));
    }

    public function TutitionsStore(Request $request)
    {
        // dd($request->all());

        $studentCount = $request->student_id;

        if ($studentCount) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $data = Tutition::where('student_id', $request->student_id[$i])->first();
                if ($data) {
                    $data->status = $request->status[$i];
                    $data->due_date = $request->due_date[$i] ? date('Y-m-d', strtotime($request->due_date[$i])) : null;
                    $data->comment = $request->comment[$i];
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

    public function TutitionDetail($id)
    {
        $data = Tutition::find($id);

        $installments = TutitionInstallment::where('tutition_id', $id)->orderBy('id', 'DESC')->get();

        $tutition_price = FeeType::where('type', 'ຄ່າຮຽນ')->first();
        $total_paid = TutitionInstallment::where('tutition_id', $id)->sum('amount');
        $total_left = $tutition_price->amount - $total_paid;

        if ($total_left == 0) {
            $data->status = 'paid';
            $data->due_date = Carbon::now();
            $data->save();
        }

        $installmentIds = [];
        foreach ($installments as $installment) {
            $installmentIds[] = $installment->id;
        }

        return view('management.tutitions.tutition_detail', compact('data', 'installments', 'tutition_price', 'total_paid', 'total_left'));
    }

    public function TutitionEdit($id)
    {
        $data = Tutition::find($id);
        return view('management.tutitions.tutition_edit', compact('data'));
    }

    public function TutitionUpdate(Request $request, $id)
    {
        $data = Tutition::find($id);
        $data->status = $request->status;
        $data->due_date = $request->due_date ? date('Y-m-d', strtotime($request->due_date)) : null;
        $data->comment = $request->comment;
        $data->modified_by = Auth::user()->id;
        $data->save();

        $notification = array(
            'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        // return redirect()->route('tutition.detail', $data->id)->with($notification);
        return redirect()->back()->with($notification);
    }
}
