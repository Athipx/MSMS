<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Assign;
use App\Models\Teacher;
use App\Models\Major;
use App\Models\Generation;
use App\Models\StudentGrade;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index()
    {
        $user_id = $user_id = Auth::user()->id;
        $teacher_id = Teacher::where('user_id', $user_id)->first();
        $students = Student::all()->count();
        // $assigns = $teacher_id->assigns_mm;

        $assigns = DB::table('assigns')
            ->select('assigns.id as id', 'subjects.subject as subject', 'generations.gen as gen', 'majors.major as major', 'semisters.semister as semister', 'classrooms.classroom as classroom')
            ->join('teacher_assigns', 'assigns.id', 'teacher_assigns.assign_id')
            ->join('subjects', 'assigns.subject_id', 'subjects.id')
            ->join('generations', 'assigns.gen_id', 'generations.id')
            ->join('majors', 'assigns.major_id', 'majors.id')
            ->join('semisters', 'assigns.semister_id', 'semisters.id')
            ->join('classrooms', 'assigns.classroom_id', 'classrooms.id')
            ->where('teacher_assigns.teacher_id', $teacher_id->id)
            ->get();

        $count_assign = DB::table('assigns')
            ->select('assigns.*')
            ->join('teacher_assigns', 'assigns.id', 'teacher_assigns.assign_id')
            ->where('teacher_assigns.teacher_id', $teacher_id->id)
            ->count();
        return view('teacher.index', compact('students', 'assigns', 'count_assign'));
    }

    public function ProfileDetail()
    {
        $user_id = Auth::user()->id;
        $data = Teacher::where('user_id', $user_id)->first();
        return view('teacher.profile', compact('data'));
    }

    public function ProfileEdit()
    {
        $user_id = Auth::user()->id;
        $editData = Teacher::where('user_id', $user_id)->first();
        $major = Major::all();
        return view('teacher.profile_edit', compact('editData', 'major'));
    }

    public function UpdatePwd(Request $request)
    {
        // Validate the user input
        $request->validate(
            [
                'old_pwd' => 'required',
                'new_pwd' => 'required',
                'confirm_pwd' => 'required|same:new_pwd',
            ],
            [
                'old_pwd.required' => 'ກະລຸນາປ້ອນລະຫັດຜ່ານເກົ່າ',
                'new_pwd.required' => 'ກະລຸນາປ້ອນລະຫັດຜ່ານໃໝ່',
                'confirm_pwd.required' => 'ກະລຸນາປ້ອນຢືນຢັນລະຫັດຜ່ານໃໝ່',
                'confirm_pwd.same' => 'ຕ້ອງກົງກັບລະຫັດຜ່ານໃໝ່',
            ]
        );

        // Get the authenticated user's current password from the database
        $currentPassword = Auth::user()->password;

        // Verify that the old password matches the current password
        if (!Hash::check($request->old_pwd, $currentPassword)) {
            return back()->withErrors(['old_pwd' => 'ລະຫັດຜ່ານເກົ່າບໍ່ຖືກຕ້ອງ']);
        }

        // Hash the new password and update the user's password in the database
        $newPassword = Hash::make($request->new_pwd);
        Auth::user()->update(['password' => $newPassword]);

        $notification = array(
            'message' => 'ປ່ຽນລະຫັດຜ່ານສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ProfileUpdate(Request $request)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'fname_lo' => 'required',
            'lname_lo' => 'required',
            'fname_en' => 'required',
            'lname_en' => 'required',
            'username' => [
                'required',
                Rule::unique('users')->ignore($user_id),
            ],
            'email' => [
                'required',
                Rule::unique('users')->ignore($user_id),
            ],
        ], [
            'fname_lo.required' => 'ກະລຸນາປ້ອນຊື່ພາສາລາວ',
            'lname_lo.required' => 'ກະລຸນາປ້ອນນາມສະກຸນພາສາລາວ',
            'fname_en.required' => 'ກະລຸນາປ້ອນຊື່ພາສາອັງກິດ',
            'lname_en.required' => 'ກະລຸນາປ້ອນນາມສະກຸນພາສາອັງກິດ',
            'username.required' => 'ກະລຸນາປ້ອນຊື່ຜູ້ໃຊ້',
            'username.unique' => 'ມີຊື່ຜູ້ໃຊ້ນີ້ໃນລະບົບແລ້ວ',
            'email.required' => 'ກະລຸນາປ້ອນອີເມວ',
            'email.unique' => 'ມີອີເມວນີ້ໃນລະບົບແລ້ວ',
        ]);

        // ເຂົ້າລະຫັດຮູບ
        $profile = $request->profile;

        if ($profile) {
            //Generate ຊື່ຮູບ
            $name_generate = hexdec(uniqid());
            //ດຶງນາມສະກຸນຮູບ
            $img_ext = strtolower($profile->getClientOriginalExtension());
            //ລວມຊື່ ແລະ ນາມສະກຸນຮູບເຂົ້າກັນ
            $imageName = $name_generate . '.' . $img_ext;
            //path ເກັບຮູບ
            $upload_location = 'upload/images/profiles/';
            $full_path = $upload_location . $imageName;

            $user = Auth::user();
            $user->fname_lo = $request->fname_lo;
            $user->lname_lo = $request->lname_lo;
            $user->fname_en = $request->fname_en;
            $user->lname_en = $request->lname_en;
            $user->username = $request->username;
            $user->status = $request->status;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->profile = $full_path;
            $user->modified_by = Auth::user()->id;
            $user->save();

            $teacher = Teacher::where('user_id', $user->id)->first();
            $teacher->major_id = $request->major;
            $teacher->phone = $request->phone;
            $teacher->position = $request->position;
            $teacher->modified_by = Auth::user()->id;
            $teacher->save();

            //ຍ້າຍຮູບ
            $profile->move($upload_location, $imageName);

            $notification = array(
                'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            $user = Auth::user();
            $user->fname_lo = $request->fname_lo;
            $user->lname_lo = $request->lname_lo;
            $user->fname_en = $request->fname_en;
            $user->lname_en = $request->lname_en;
            $user->username = $request->username;
            $user->status = $request->status;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->modified_by = Auth::user()->id;
            $user->save();

            $teacher = Teacher::where('user_id', $user->id)->first();
            $teacher->major_id = $request->major;
            $teacher->phone = $request->phone;
            $teacher->position = $request->position;
            $teacher->modified_by = Auth::user()->id;
            $teacher->save();

            $notification = array(
                'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }


    // ----------------------------------------------------- Assigns Function -----------------------------------------------------------


    public function AssignsView(Request $request)
    {
        $major = Major::where('deleted', false)->get();
        $gen = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();

        $major_id = $request->major_id;
        $gen_id = $request->gen_id;

        $user_id = $user_id = Auth::user()->id;
        $teacher_id = Teacher::where('user_id', $user_id)->first();

        $assigns = DB::table('assigns')
            ->select('assigns.id as id', 'subjects.subject as subject', 'generations.gen as gen', 'majors.major as major', 'semisters.semister as semister', 'classrooms.classroom as classroom')
            ->join('teacher_assigns', 'assigns.id', 'teacher_assigns.assign_id')
            ->join('subjects', 'assigns.subject_id', 'subjects.id')
            ->join('generations', 'assigns.gen_id', 'generations.id')
            ->join('majors', 'assigns.major_id', 'majors.id')
            ->join('semisters', 'assigns.semister_id', 'semisters.id')
            ->join('classrooms', 'assigns.classroom_id', 'classrooms.id')
            ->where('teacher_assigns.teacher_id', $teacher_id->id);

        if ($major_id) {
            $assigns->where('assigns.major_id', $major_id);
        }

        if ($gen_id) {
            $assigns->where('assigns.gen_id', $gen_id);
        }

        $assigns = $assigns->get();

        return view('teacher.assigns.assigns_view', compact('assigns', 'major', 'gen', 'major_id', 'gen_id'));
    }

    public function AssignDetail($id)
    {
        $data = Assign::find($id);

        $teachers = DB::table('assigns')
            ->select('users.*')
            ->join('teacher_assigns', 'teacher_assigns.assign_id', 'assigns.id')
            ->join('teachers', 'teacher_assigns.teacher_id', 'teachers.id')
            ->join('users', 'teachers.user_id', 'users.id')
            ->where('assigns.id', $id)
            ->get();

        return view('teacher.assigns.assign_detail', compact('data', 'teachers'));
    }





    // ----------------------------------------------------- Grade Function -----------------------------------------------------------

    public function GetSubjects(Request $request)
    {
        $user_id = $user_id = Auth::user()->id;
        $teacher_id = Teacher::where('user_id', $user_id)->first();
        $major_id = $request->major_id;
        $gen_id = $request->gen_id;
        // $allData = Assign::with('subject')
        //     ->where('major_id', $major_id)
        //     ->where('gen_id', $gen_id)
        //     ->get();
        $allData = DB::table('assigns')
            ->select('assigns.id as id', 'subjects.subject as subject')
            ->join('teacher_assigns', 'assigns.id', 'teacher_assigns.assign_id')
            ->join('subjects', 'assigns.subject_id', 'subjects.id')
            ->join('generations', 'assigns.gen_id', 'generations.id')
            ->join('majors', 'assigns.major_id', 'majors.id')
            ->where('teacher_assigns.teacher_id', $teacher_id->id)
            ->where('assigns.major_id', $major_id)
            ->where('assigns.gen_id', $gen_id)
            ->get();

        return response()->json($allData);
    }

    public function GetStudents(Request $request)
    {
        $major_id = $request->major_id;
        $gen_id = $request->gen_id;
        $assign = $request->subject_id;

        $allData = Student::with('user', 'major', 'gen')
            ->where('major_id', $major_id)
            ->where('gen_id', $gen_id)
            ->whereNotIn('status', ['pending', 'graduated', 'drop', 'quit'])
            ->get();

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
        $gens = Generation::orderBy('id', 'DESC')->get();
        $majors = Major::all();
        $subjects = Subject::all();

        return view('teacher.grades.grades_view', compact('gens', 'majors', 'subjects'));
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

        return view('teacher.grades.grade_filterResults', compact('grades', 'gens', 'majors', 'major', 'gen', 'subject'));
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
        return view('teacher.grades.grade_detail', compact('data', 'modified_by', 'teachers'));
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

        return view('teacher.grades.grades_add', compact('gen', 'majors', 'students', 'subjects'));
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
                    $data->modified_by = Auth::user()->id;
                    $data->save();
                    // dd($request->all());
                } else {
                    // insert new record
                    $data = new StudentGrade;
                    $data->assign_id = $request->subject_id;
                    $data->student_id = $request->student_id[$i];
                    $data->grade = $request->grade[$i];
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
        return view('teacher.grades.grade_edit', compact('editData'));
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
