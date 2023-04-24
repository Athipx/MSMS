<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function UsersView()
    {
        $data = User::where('deleted', false)
            ->whereIn('role', ['admin', 'coordinator', 'headUnit', 'headDept'])
            ->get();
        $usersTrash = User::where('deleted', true)->get();
        return view('management.users.users_view', compact('data', 'usersTrash'));
    }

    public function UsersAdd()
    {
        return view('management.users.users_add');
    }

    public function UserStore(Request $request)
    {

        $request->validate([
            'fname_lo' => 'required',
            'lname_lo' => 'required',
            'fname_en' => 'required',
            'lname_en' => 'required',
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

        //ເຂົ້າລະຫັດຮູບ
        $profile = $request->profile;
        $data = new User;

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

            $data->fname_lo = $request->fname_lo;
            $data->lname_lo = $request->lname_lo;
            $data->fname_en = $request->fname_en;
            $data->lname_en = $request->lname_en;
            $data->username = $request->username;
            $data->role = $request->role;
            $data->status = $request->status;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->profile = $full_path;
            $data->save();

            //ຍ້າຍຮູບ
            $profile->move($upload_location, $imageName);

            $notification = array(
                'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->route('users.view')->with($notification);
        } else {
            $data->fname_lo = $request->fname_lo;
            $data->lname_lo = $request->lname_lo;
            $data->fname_en = $request->fname_en;
            $data->lname_en = $request->lname_en;
            $data->username = $request->username;
            $data->role = $request->role;
            $data->status = $request->status;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->save();

            $notification = array(
                'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->route('users.view')->with($notification);
        }
    }

    public function UsersDetail($id)
    {
        $UserData = User::find($id);
        return view('management.users.users_detail', compact('UserData'));
    }

    public function UsersEdit($id)
    {
        $editData = User::find($id);
        return view('management.users.users_edit', compact('editData'));
    }

    public function UsersUpdate(Request $request, $id)
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
            'profile.mimes' => 'ຮອງຮັບສະເພາະຮູບນາມສະກຸນ jpg, jpeg, png',
        ]);

        $profile = $request->profile;

        if ($profile) {
            //update profile & info
            //Generate ຊື່ຮູບ
            $name_generate = hexdec(uniqid());
            //ດຶງນາມສະກຸນຮູບ
            $img_ext = strtolower($profile->getClientOriginalExtension());
            //ລວມຊື່ ແລະ ນາມສະກຸນຮູບເຂົ້າກັນ
            $imageName = $name_generate . '.' . $img_ext;
            //path ເກັບຮູບ
            $upload_location = 'upload/images/profiles/';
            $full_path = $upload_location . $imageName;

            $data = User::find($id);
            $data->fname_lo = $request->fname_lo;
            $data->lname_lo = $request->lname_lo;
            $data->fname_en = $request->fname_en;
            $data->lname_en = $request->lname_en;
            $data->username = $request->username;
            $data->role = $request->role;
            $data->status = $request->status;
            $data->email = $request->email;
            $data->profile = $full_path;
            $data->save();

            //ລຶບຮູບເກົ່າແລ້ວເອົາຮູບໃໝ່ໃສ່ແທນ
            $old_profile = $request->old_profile;
            if ($old_profile) {
                unlink($old_profile);
            }
            //ຍ້າຍຮູບ
            $profile->move($upload_location, $imageName);

            $notification = array(
                'message' => 'ແກ້ໄຂຂໍ້ມູນຜູ້ໃຊ້ສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->route('users.view')->with($notification);
        } else {
            //update only info
            $data = User::find($id);
            $data->fname_lo = $request->fname_lo;
            $data->lname_lo = $request->lname_lo;
            $data->fname_en = $request->fname_en;
            $data->lname_en = $request->lname_en;
            $data->username = $request->username;
            $data->role = $request->role;
            $data->status = $request->status;
            $data->email = $request->email;
            $data->save();

            $notification = array(
                'message' => 'ແກ້ໄຂຂໍ້ມູນຜູ້ໃຊ້ສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function UsersRemove($id)
    {
        $user = User::find($id);
        $user->deleted = true;
        $user->modified_by = Auth::user()->id;
        $user->save();

        $notification = array(
            'message' => 'ລຶບຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->route('users.view')->with($notification);
    }

    public function UsersTrash()
    {
        $usersTrash = User::where('deleted', true)->get();
        return view('management.users.users_trash', compact('usersTrash'));
    }

    public function UsersRestore($id)
    {
        $user = User::find($id);
        $user->deleted = false;
        $user->modified_by = Auth::user()->id;
        $user->save();

        $notification = array(
            'message' => 'ກູ້ຄືນຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
