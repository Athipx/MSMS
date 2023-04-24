<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Major;
use App\Models\Generation;
use App\Models\Thesis;
use App\Models\Teacher;
use App\Models\PresentationLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $data = Student::where('user_id', $user_id)->firstOrFail();
        $grades_term1 = DB::table('student_grades')
            ->select('subjects.*', 'student_grades.*')
            ->join('assigns', 'student_grades.assign_id', '=', 'assigns.id')
            ->join('semisters', 'assigns.semister_id', 'semisters.id')
            ->join('subjects', 'assigns.subject_id', '=', 'subjects.id')
            ->join('students', 'student_grades.student_id', 'students.id')
            ->join('users', 'students.user_id', 'users.id')
            ->where('semisters.semister', 1)
            ->where('users.id', $user_id)
            ->get();

        $grades_term2 = DB::table('student_grades')
            ->select('subjects.*', 'student_grades.*')
            ->join('assigns', 'student_grades.assign_id', '=', 'assigns.id')
            ->join('semisters', 'assigns.semister_id', 'semisters.id')
            ->join('subjects', 'assigns.subject_id', '=', 'subjects.id')
            ->join('students', 'student_grades.student_id', 'students.id')
            ->join('users', 'students.user_id', 'users.id')
            ->where('semisters.semister', 2)
            ->where('users.id', $user_id)
            ->get();

        $grades_term3 = DB::table('student_grades')
            ->select('subjects.*', 'student_grades.*')
            ->join('assigns', 'student_grades.assign_id', '=', 'assigns.id')
            ->join('semisters', 'assigns.semister_id', 'semisters.id')
            ->join('subjects', 'assigns.subject_id', '=', 'subjects.id')
            ->join('students', 'student_grades.student_id', 'students.id')
            ->join('users', 'students.user_id', 'users.id')
            ->where('semisters.semister', 3)
            ->where('users.id', $user_id)
            ->get();

        $grades_term4 = DB::table('student_grades')
            ->select('subjects.*', 'student_grades.*')
            ->join('assigns', 'student_grades.assign_id', '=', 'assigns.id')
            ->join('semisters', 'assigns.semister_id', 'semisters.id')
            ->join('subjects', 'assigns.subject_id', '=', 'subjects.id')
            ->join('students', 'student_grades.student_id', 'students.id')
            ->join('users', 'students.user_id', 'users.id')
            ->where('semisters.semister', 4)
            ->where('users.id', $user_id)
            ->get();

        $thesis = Thesis::where('student_id', $data->id)->firstOrFail();

        $teachers = Teacher::where('deleted', false)->get();
        $logs = PresentationLog::where('thesis_id', $thesis->id)->get();

        $co_advisers = DB::table('thesis_advisers')
            ->select('users.*')
            ->join('teachers', 'thesis_advisers.teacher_id', 'teachers.id')
            ->join('users', 'teachers.user_id', 'users.id')
            ->where('thesis_advisers.thesis_id', $thesis->id)
            ->get();

        foreach ($logs as $log) {
            $committees = DB::table('committees')
                ->select('users.fname_lo', 'users.lname_lo')
                ->join('teachers', 'committees.teacher_id', 'teachers.id')
                ->join('users', 'teachers.user_id', 'users.id')
                ->where('committees.presentation_log_id', $log->id)
                ->get();

            $log->committees = $committees;
        }

        return view('student.index', compact('data', 'grades_term1', 'grades_term2', 'grades_term3', 'grades_term4', 'thesis', 'logs', 'co_advisers'));

        // dd($grades_term1); // this line will dump the contents of $grades_term1
    }

    public function ChangePwd()
    {
        return view('student.change_password');
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

        return redirect()->route('student.dashboard')->with('success', 'ປ່ຽນລະຫັດຜ່ານສຳເລັດ');
    }

    public function ProfileEdit()
    {
        $user_id = Auth::user()->id;
        $editData = Student::where('user_id', $user_id)->firstOrFail();
        $major = Major::where('deleted', false)->get();
        $gen = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();
        return view('student.profile_edit', compact('editData', 'major', 'gen'));
    }

    public function ProfileUpdate(Request $request)
    {
        $user_id = Auth::user()->id;
        $editData = Student::where('user_id', $user_id)->firstOrFail();

        $request->validate([
            'fname_lo' => 'required',
            'lname_lo' => 'required',
            'fname_en' => 'required',
            'lname_en' => 'required',
            'dob' => 'nullable|date',
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

        // // //ເຂົ້າລະຫັດຮູບ
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
            $user->profile = $full_path;
            $user->modified_by = Auth::user()->id;
            $user->save();

            $student = Student::where('user_id', $user->id)->first();
            $student->student_id = $request->student_id;
            $student->gen_id = $request->gen;
            $student->major_id = $request->major;
            $student->status = $request->student_status;
            $student->gender = $request->gender;
            $student->begin_date = $request->begin_date ? date('Y-m-d', strtotime($request->begin_date)) : null;
            $student->graduated_date = $request->graduated_date ? date('Y-m-d', strtotime($request->graduated_date)) : null;
            $student->dob = $request->dob ? date('Y-m-d', strtotime($request->dob)) : null;
            $student->phone = $request->phone ?? null;
            $student->born_village = $request->born_village ?? null;
            $student->born_district = $request->born_district ?? null;
            $student->born_province = $request->born_province ?? null;
            $student->current_village = $request->current_village ?? null;
            $student->current_district = $request->current_district ?? null;
            $student->current_province = $request->current_province ?? null;
            $student->bd_graduated_year = $request->bd_graduated_year ?? null;
            $student->bd_academy = $request->bd_academy ?? null;
            $student->bd_major = $request->bd_major ?? null;
            $student->bd_grade = $request->bd_grade ?? null;
            $student->working_org = $request->working_org ?? null;
            $student->working_place = $request->working_place ?? null;
            $student->working_duration = $request->working_duration ?? null;
            $student->modified_by = Auth::user()->id;
            $student->save();

            //ຍ້າຍຮູບ
            $profile->move($upload_location, $imageName);

            return redirect()->route('student.dashboard')->with('success', 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ');
        } else {
            $user = Auth::user();
            $user->fname_lo = $request->fname_lo;
            $user->lname_lo = $request->lname_lo;
            $user->fname_en = $request->fname_en;
            $user->lname_en = $request->lname_en;
            $user->username = $request->username;
            $user->status = $request->status;
            $user->email = $request->email;
            $user->modified_by = Auth::user()->id;
            $user->save();

            $student = Student::where('user_id', $user->id)->first();
            $student->student_id = $request->student_id;
            $student->gen_id = $request->gen;
            $student->major_id = $request->major;
            $student->status = $request->student_status;
            $student->gender = $request->gender;
            $student->begin_date = $request->begin_date ? date('Y-m-d', strtotime($request->begin_date)) : null;
            $student->graduated_date = $request->graduated_date ? date('Y-m-d', strtotime($request->graduated_date)) : null;
            $student->dob = $request->dob ? date('Y-m-d', strtotime($request->dob)) : null;
            $student->phone = $request->phone;
            $student->born_village = $request->born_village;
            $student->born_district = $request->born_district;
            $student->born_province = $request->born_province;
            $student->current_village = $request->current_village;
            $student->current_district = $request->current_district;
            $student->current_province = $request->current_province;
            $student->bd_graduated_year = $request->bd_graduated_year ?? null;
            $student->bd_academy = $request->bd_academy ?? null;
            $student->bd_major = $request->bd_major ?? null;
            $student->bd_grade = $request->bd_grade ?? null;
            $student->working_org = $request->working_org ?? null;
            $student->working_place = $request->working_place ?? null;
            $student->working_duration = $request->working_duration ?? null;
            $student->modified_by = Auth::user()->id;
            $student->save();

            return redirect()->route('student.dashboard')->with('success', 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ');
        }
    }
}
