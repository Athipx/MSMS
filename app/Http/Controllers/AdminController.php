<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Thesis;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $data['allUsers'] = User::all();
        $data['allStudents'] = User::where('role', 'student')->get();
        $data['allTeachers'] = User::where('role', 'teacher')->get();
        $data['allTheses'] = Thesis::all();

        $students = DB::table('student_fees')
            ->select('users.fname_lo as fname', 'student_fees.due_date as date', 'fee_types.type as type', 'users.lname_lo as lname', 'generations.gen as gen', 'majors.major as major', 'student_fees.status as status', 'students.student_id as student_id', 'students.id as id')
            ->join('students', 'student_fees.student_id', 'students.id')
            ->join('users', 'students.user_id', 'users.id')
            ->join('majors', 'student_fees.major_id', 'majors.id')
            ->join('generations', 'student_fees.gen_id', 'generations.id')
            ->join('fee_types', 'student_fees.fee_type_id', 'fee_types.id')
            ->limit(6)
            ->orderBy('id', 'DESC')
            ->get();


        return view('admin.index', $data, compact('students'));
    }

    public function test()
    {
        return view('admin.test');
    }
}
