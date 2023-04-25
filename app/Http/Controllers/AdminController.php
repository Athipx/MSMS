<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Thesis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

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

    public function ProfileDetail()
    {
        $id = Auth::user()->id;
        $UserData = User::find($id);
        return view('admin.profile', compact('UserData'));
    }

    public function ProfileEdit()
    {
        $user_id = Auth::user()->id;
        $editData = User::where('id', $user_id)->first();
        return view('admin.profile_edit', compact('editData'));
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
                'confirm_pwd.same' => 'ລະຫັດຢືນຢັນຕ້ອງກົງກັບລະຫັດຜ່ານໃໝ່',
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
            $user->status = $request->status;
            $user->profile = $full_path;
            $user->modified_by = Auth::user()->id;
            $user->save();

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

            $notification = array(
                'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }
}
