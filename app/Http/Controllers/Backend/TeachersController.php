<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Major;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeachersController extends Controller
{
    public function TeachersView()
    {
        $data = Teacher::where('deleted', false)->get();
        $countTrash = Teacher::where('deleted', true)->count();
        return view('management.teachers.teachers_view', compact('data', 'countTrash'));
    }

    public function TeacherDetail($id)
    {
        $data = Teacher::find($id);
        return view('management.teachers.teacher_detail', compact('data'));
    }

    public function TeachersAdd()
    {
        $users = User::all();
        $major = Major::all();

        return view('management.teachers.teachers_add', compact('users', 'major'));
    }

    public function TeacherStore(Request $request)
    {
        $request->validate(
            [
                'fname_lo' => 'required',
                'lname_lo' => 'required',
                'fname_en' => 'required',
                'lname_en' => 'required',
                'username' => 'required|unique:users',
                'email' => 'required|unique:users',
                'password' => 'required',
                'profile' => 'mimes:jpg,png,jpeg',
            ],
            [
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
            ]
        );

        //ເຂົ້າລະຫັດຮູບ
        $profile = $request->profile;
        $user = new User;
        $teacher = new Teacher;

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
            $user->role = $request->role;
            $user->password = bcrypt($request->password);
            $user->profile = $full_path;
            $user->phone = $request->phone;
            $user->modified_by = Auth::user()->id;
            $user->save();

            $teacher->user_id = $user->id;
            $teacher->major_id = $request->major;
            $teacher->position = $request->position;
            $teacher->expert = $request->expert;
            $teacher->save();

            //ຍ້າຍຮູບ
            $profile->move($upload_location, $imageName);

            $notification = array(
                'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->route('teachers.view')->with($notification);
        } else {
            $user->fname_lo = $request->fname_lo;
            $user->lname_lo = $request->lname_lo;
            $user->fname_en = $request->fname_en;
            $user->lname_en = $request->lname_en;
            $user->username = $request->username;
            $user->status = $request->status;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->password = bcrypt($request->password);
            $user->phone = $request->phone;
            $user->modified_by = Auth::user()->id;
            $user->save();

            $teacher->user_id = $user->id;
            $teacher->major_id = $request->major;
            $teacher->position = $request->position;
            $teacher->expert = $request->expert;
            $teacher->save();

            $notification = array(
                'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->route('teachers.view')->with($notification);
        }

        // $input = $request->all();
        // dd($input);
    }

    public function TeacherEdit($id)
    {
        $editData = Teacher::find($id);
        $major = Major::all();
        return view('management.teachers.teacher_edit', compact('editData', 'major'));
    }

    public function TeacherUpdate(Request $request, $id)
    {
        $request->validate([
            'fname_lo' => 'required',
            'lname_lo' => 'required',
            'fname_en' => 'required',
            'lname_en' => 'required',
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

            $user = User::find($id);
            $user->fname_lo = $request->fname_lo;
            $user->lname_lo = $request->lname_lo;
            $user->fname_en = $request->fname_en;
            $user->lname_en = $request->lname_en;
            $user->username = $request->username;
            $user->status = $request->status;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->password = bcrypt($request->password);
            $user->profile = $full_path;
            $user->phone = $request->phone;
            $user->modified_by = Auth::user()->id;
            $user->save();

            $teacher = Teacher::where('user_id', $user->id)->first();
            $teacher->major_id = $request->major;
            $teacher->position = $request->position;
            $teacher->expert = $request->expert;
            $teacher->save();

            //ຍ້າຍຮູບ
            $profile->move($upload_location, $imageName);

            $notification = array(
                'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->route('teachers.view')->with($notification);
        } else {
            $user = User::find($id);
            $user->fname_lo = $request->fname_lo;
            $user->lname_lo = $request->lname_lo;
            $user->fname_en = $request->fname_en;
            $user->lname_en = $request->lname_en;
            $user->username = $request->username;
            $user->status = $request->status;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->password = bcrypt($request->password);
            $user->phone = $request->phone;
            $user->modified_by = Auth::user()->id;
            $user->save();

            $teacher = Teacher::where('user_id', $user->id)->first();
            $teacher->major_id = $request->major;
            $teacher->position = $request->position;
            $teacher->expert = $request->expert;
            $teacher->save();

            $notification = array(
                'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function TeachersTrash()
    {
        $trash = Teacher::where('deleted', true)->get();
        return view('management.teachers.teachers_trash', compact('trash'));
    }

    public function TeacherRemove($id)
    {
        $user = User::find($id);
        $user->status = 'inactive';
        $user->save();

        $teacher = Teacher::where('user_id', $user->id)->first();
        $teacher->deleted = true;
        $teacher->save();

        $notification = array(
            'message' => 'ລຶບຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->route('teachers.view')->with($notification);
    }

    public function TeacherRestore($id)
    {
        $user = User::find($id);
        $user->status = 'active';
        $user->save();

        $teacher = Teacher::where('user_id', $user->id)->first();
        $teacher->deleted = false;
        $teacher->save();

        $notification = array(
            'message' => 'ກູ້ຄືນຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->route('teachers.trash')->with($notification);
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
}
