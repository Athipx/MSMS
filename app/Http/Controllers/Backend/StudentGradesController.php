<?php

namespace App\Http\Controllers\Backend;

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

class StudentGradesController extends Controller
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

    public function GetStudents(Request $request)
    {
        $major_id = $request->major_id;
        $gen_id = $request->gen_id;
        $assign = $request->subject_id;

        // $countAssign = StudentGrade::where('assign_id', $assign)->count();

        $allData = Student::with('user', 'major', 'gen')
            ->where('major_id', $major_id)
            ->where('gen_id', $gen_id)
            ->whereNotIn('status', ['pending', 'graduated', 'drop', 'quit'])
            ->get();

        // if ($countAssign == 0 || $countMajor == $major_id || $countGen == $gen_id) {
        //     foreach ($allData as $data) {
        //         $countGrade = StudentGrade::where('assign_id', $assign)
        //             ->where('student_id', $data->id)
        //             ->count();
        //         if ($countGrade == 0) {
        //             StudentGrade::create([
        //                 'assign_id' => $assign,
        //                 'student_id' => $data->id,
        //                 'grade' => 'N/A'
        //             ]);
        //         }
        //     }
        // }

        foreach ($allData as $data) {
            $countGrade = StudentGrade::where('assign_id', $assign)
                ->where('student_id', $data->id)
                ->count();
            if ($countGrade == 0) {
                StudentGrade::create([
                    'assign_id' => $assign,
                    'student_id' => $data->id,
                    'grade' => 'N/A'
                ]);
            }
        }

        $studentGrade = DB::table('student_grades')
            ->select('users.fname_lo as fname_lo', 'users.lname_lo as lname_lo', 'student_grades.grade as grade', 'student_grades.old_grade as old_grade', 'student_grades.description as description', 'students.student_id as student_id', 'students.id as id')
            ->join('assigns', 'student_grades.assign_id', 'assigns.id')
            ->join('students', 'student_grades.student_id', 'students.id')
            ->join('users', 'students.user_id', 'users.id')
            ->where('student_grades.assign_id', $assign)
            ->get();

        return response()->json($studentGrade);
    }

    public function GradesView(Request $request)
    {
        $gen = Generation::orderBy('id', 'DESC')->get();
        $majors = Major::all();
        $subjects = Subject::all();

        return view('management.grades.grades_view', compact('gen', 'majors', 'subjects'));
    }

    public function filterResult(Request $request)
    {
        $major = $request->major_id;
        $gen = $request->gen_id;
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
            ->where('majors.id', $major)
            ->where('generations.id', $gen)
            ->where('assigns.id', $subject)
            ->get();
        return view('management.grades.grades_filterResult', compact('grades', 'major', 'gen', 'subject'));
        // dd($request->all());
    }

    public function filterResults(Request $request)
    {
        $gens = Generation::orderBy('id', 'DESC')->get();
        $majors = Major::all();

        $major = $request->major_id;
        $gen = $request->gen_id;
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
            ->where('majors.id', $major)
            ->where('generations.id', $gen)
            ->where('assigns.id', $subject)
            ->get();

        return view('management.grades.grade_filterResults', compact('grades', 'gens', 'majors', 'major', 'gen', 'subject'));
    }

    public function StudentGradeDetail($id)
    {
        $data = StudentGrade::find($id);
        $teachers = DB::table('student_grades')
            ->select('users.*')
            ->join('assigns', 'student_grades.assign_id', 'assigns.id')
            ->join('teacher_assigns', 'teacher_assigns.assign_id', 'assigns.id')
            ->join('teachers', 'teacher_assigns.teacher_id', 'teachers.id')
            ->join('users', 'teachers.user_id', 'users.id')
            ->where('student_grades.id', $id)
            ->get();
        $modified_by = $data->editor->fname_lo;
        return view('management.grades.studentGrade_detail', compact('data', 'modified_by', 'teachers'));
    }

    public function GradesAdd(Request $request)
    {
        $gen = Generation::orderBy('id', 'DESC')->get();
        $majors = Major::all();
        // $subjects = Subject::all();

        $gen_id = $request->input('gen_id');
        $major_id = $request->input('major_id');

        $data = DB::table('students')
            ->join('users', 'students.user_id', 'users.id')
            ->join('generations', 'students.gen_id', 'generations.id')
            ->join('majors', 'students.major_id', 'majors.id')
            ->select('students.student_id as id', 'users.fname_lo as fname', 'users.lname_lo as lname', 'majors.major as major', 'generations.gen as gen')
            ->where('students.deleted', false);

        if ($gen_id) {
            $data->where('generations.id', $gen_id);
        }

        if ($major_id) {
            $data->where('majors.id', $major_id);
        }

        $students = $data->get();


        $subjects = Assign::with('subject')
            ->where('major_id', $major_id)
            ->where('gen_id', $gen_id)
            ->get();

        return view('management.grades.grades_add', compact('gen', 'majors', 'students', 'subjects'));
    }

    public function GradesStore(Request $request)
    {
        $studentCount = $request->student_id;

        if ($studentCount) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $data = StudentGrade::where('assign_id', $request->subject_id)
                    ->where('student_id', $request->student_id[$i])
                    ->first();
                if ($data) {
                    $data->grade = $request->grade[$i];
                    // $data->old_grade = $request->old_grade[$i];
                    // $data->upgrade_date = $request->upgrade_date[$i] ? date('Y-m-d', strtotime($request->upgrade_date[$i])) : null;
                    // $data->description = $request->description[$i];
                    $data->modified_by = Auth::user()->id;
                    $data->save();
                    // dd($request->all());
                } else {
                    // insert new record
                    $data = new StudentGrade;
                    $data->assign_id = $request->subject_id;
                    $data->student_id = $request->student_id[$i];
                    $data->grade = $request->grade[$i];
                    // $data->old_grade = $request->old_grade[$i];
                    // $data->upgrade_date = $request->upgrade_date[$i] ? date('Y-m-d', strtotime($request->upgrade_date[$i])) : null;
                    // $data->description = $request->description[$i];
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

    public function GradeEdit($id)
    {
        $editData = StudentGrade::find($id);
        return view('management.grades.grade_edit', compact('editData'));
    }

    public function GradeUpdate(Request $request, $id)
    {
        // $request->validate(['upgrade_date' => 'nullable|date']);

        $data = StudentGrade::find($id);
        $data->assign_id = $request->assign_id;
        $data->student_id = $request->student_id;
        $data->grade = $request->grade;
        $data->old_grade = $request->old_grade;
        $data->upgrade_date = $request->upgrade_date ? date('Y-m-d', strtotime($request->upgrade_date)) : null;
        $data->description = $request->description;
        $data->modified_by = Auth::user()->id;
        $data->save();

        $notification = array(
            'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        // dd($request->all());
    }
}
