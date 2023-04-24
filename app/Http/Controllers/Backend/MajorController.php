<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Major;
use Illuminate\Validation\Rule;

class MajorController extends Controller
{
    public function MajorsView()
    {
        $data = Major::where('deleted', false)->orderBy('id', 'desc')->paginate(9);
        $trash = Major::where('deleted', true)->count();
        return view('management.majors.majors', compact('data', 'trash'));
    }

    public function MajorAdd(Request $request)
    {
        $request->validate(
            [
                'major' => 'required|unique:majors',
            ],
            [
                'major.required' => 'ກະລຸນາຊື່ສາຂາວິຊາ',
                'major.unique' => 'ມີສາຂາວິຊານີ້ໃນລະບົບແລ້ວ',
            ]
        );

        // dd($request->all());
        $major = new Major;
        $major->major = $request->major;
        $major->save();

        $notification = array(
            'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->route('majors.view')->with($notification);
    }

    public function MajorUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'major' => ['required', Rule::unique('majors')->ignore($id)],
            ],
            [
                'major.required' => 'ກະລຸນາປ້ອນເລກຮຸ່ນ',
                'major.unique' => 'ມີເລກຮຸ່ນນີ້ໃນລະບົບແລ້ວ',
            ]
        );

        $major = Major::find($id);
        $major->major = $request->major;
        $major->save();

        $notification = array(
            'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->route('majors.view')->with($notification);
    }

    public function MajorRemove($id)
    {
        $major = Major::find($id);
        $major->deleted = true;
        $major->save();

        $notification = array(
            'message' => 'ລຶບຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->route('majors.view')->with($notification);
    }

    public function MajorTrash()
    {
        $majorTrash = Major::where('deleted', true)->paginate(9);
        return view('management.majors.majors_trash', compact('majorTrash'));
    }

    public function MajorRestore($id)
    {
        $major = Major::find($id);
        $major->deleted = false;
        $major->save();

        $notification = array(
            'message' => 'ກູ້ຄືນຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
