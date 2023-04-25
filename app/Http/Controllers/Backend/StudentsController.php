<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\User;
use App\Models\Generation;
use App\Models\Major;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentsController extends Controller
{
    public function StudentsView()
    {
        // $studentData = DB::table('students')
        //     ->join('users', 'students.user_id', 'users.id')
        //     ->join('majors', 'students.major_id', 'majors.id')
        //     ->join('generations', 'students.gen_id', 'generations.id')
        //     ->select('students.*', 'users.fname_lo', 'users.lname_lo', 'users.fname_en', 'users.lname_en', 'users.profile', 'users.created_at', 'generations.gen', 'majors.major')
        //     ->get();

        // $studentData = Student::with('user', 'major', 'generation')->get();

        $studentData = Student::where('deleted', false)->get();
        $trash = Student::where('deleted', true)->count();

        return view('management.students.students_view', compact('studentData', 'trash'));
    }

    public function StudentDetail($id)
    {
        $data = Student::find($id);
        return view('management.students.student_detail', compact('data'));
    }

    public function StudentsAdd()
    {
        $users = User::all();
        $gen = Generation::all();
        $student = Student::all();
        $major = Major::all();

        return view('management.students.students_add', compact('users', 'major', 'student', 'gen'));
    }

    public function StudentStore(Request $request)
    {
        $request->validate([
            'fname_lo' => 'required',
            'lname_lo' => 'required',
            'fname_en' => 'required',
            'lname_en' => 'required',
            'dob' => 'nullable|date',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'profile' => 'mimes:jpg,png,jpeg',
        ], [
            'fname_lo.required' => 'ກະລຸນາປ້ອນຊື່ພາສາລາວ',
            'lname_lo.required' => 'ກະລຸນາປ້ອນນາມສະກຸນພາສາລາວ',
            'fname_en.required' => 'ກະລຸນາປ້ອນຊື່ພາສາອັງກິດ',
            'lname_en.required' => 'ກະລຸນາປ້ອນນາມສະກຸນພາສາອັງກິດ',
            'username.required' => 'ກະລຸນາປ້ອນຊື່ຜູ້ໃຊ້',
            'username.unique' => 'ມີຊື່ຜູ້ໃຊ້ນີ້ໃນລະບົບແລ້ວ',
            'email.required' => 'ກະລຸນາປ້ອນອີເມວ',
            'email.unique' => 'ມີອີເມວນີ້ໃນລະບົບແລ້ວ',
            'password.required' => 'ກະລຸນາປ້ອນລະຫັດຜ່ານ',
            'profile.mimes' => 'ຮອງຮັບສະເພາະຮູບນາມສະກຸນ jpg, jpeg, png',
        ]);

        // //ເຂົ້າລະຫັດຮູບ
        $profile = $request->profile;
        $user = new User;
        $student = new Student;

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

            $user->fname_lo = $request->fname_lo;
            $user->lname_lo = $request->lname_lo;
            $user->fname_en = $request->fname_en;
            $user->lname_en = $request->lname_en;
            $user->username = $request->username;
            $user->status = $request->status;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->profile = $full_path;
            $user->modified_by = Auth::user()->id;
            $user->save();

            $student->user_id = $user->id;
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

            $notification = array(
                'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->route('students.view')->with($notification);
        } else {
            $user->fname_lo = $request->fname_lo;
            $user->lname_lo = $request->lname_lo;
            $user->fname_en = $request->fname_en;
            $user->lname_en = $request->lname_en;
            $user->username = $request->username;
            $user->status = $request->status;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->modified_by = Auth::user()->id;
            $user->save();

            $student->user_id = $user->id;
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

            $notification = array(
                'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->route('students.view')->with($notification);
        }
    }

    public function StudentEdit($id)
    {
        $editData = Student::find($id);
        $major = Major::all();
        $gen = Generation::all();

        return view('management.students.student_edit', compact('editData', 'major', 'gen'));
    }

    public function StudentUpdate(Request $request, $id)
    {

        $request->validate([
            'fname_lo' => 'required',
            'lname_lo' => 'required',
            'fname_en' => 'required',
            'lname_en' => 'required',
            'dob' => 'nullable|date',
            'username' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
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

            $user = User::find($id);
            $user->fname_lo = $request->fname_lo;
            $user->lname_lo = $request->lname_lo;
            $user->fname_en = $request->fname_en;
            $user->lname_en = $request->lname_en;
            $user->username = $request->username;
            $user->status = $request->status;
            $user->email = $request->email;
            $user->profile = $full_path;
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
            $student->save();

            //ຍ້າຍຮູບ
            $profile->move($upload_location, $imageName);

            $notification = array(
                'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->route('students.view')->with($notification);
        } else {
            $user = User::find($id);
            $user->fname_lo = $request->fname_lo;
            $user->lname_lo = $request->lname_lo;
            $user->fname_en = $request->fname_en;
            $user->lname_en = $request->lname_en;
            $user->username = $request->username;
            $user->status = $request->status;
            $user->email = $request->email;
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
            $student->save();

            $notification = array(
                'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function StudentRemove($id)
    {
        $user = User::find($id);
        $user->status = 'inactive';
        $user->save();

        $teacher = Student::where('user_id', $user->id)->first();
        $teacher->deleted = true;
        $teacher->save();

        $notification = array(
            'message' => 'ລຶບຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->route('students.view')->with($notification);
    }

    public function StudentsTrash()
    {
        $trash = Student::where('deleted', true)->get();
        return view('management.students.students_trash', compact('trash'));
    }

    public function StudentRestore($id)
    {
        $user = User::find($id);
        $user->status = 'active';
        $user->save();

        $teacher = Student::where('user_id', $user->id)->first();
        $teacher->deleted = false;
        $teacher->save();

        $notification = array(
            'message' => 'ກູ້ຄືນຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->route('students.view')->with($notification);
    }

    public function ResetPwd(Request $request, $id)
    {
        $request->validate([
            'password' => 'required'
        ], [
            'password.required' => 'ກະລຸນາປ້ອນລະຫັດຜ່ານກ່ອນ'
        ]);

        // dd($request->all());
        $data = User::find($id);
        $data->password = bcrypt($request->password);
        $data->save();

        $notification = array(
            'message' => 'ປ່ຽນລະຫັດຜ່ານສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function StudentsImport()
    {
        return view('management.students.students_import');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        $file = $request->file('file');
        Excel::import(new StudentsImport, $file);

        $notification = array(
            'message' => 'Import ຂໍ້ມູນນັກສຶກສາສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
