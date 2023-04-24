<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use Illuminate\Validation\Rule;

class ClassroomsController extends Controller
{
    public function ClassView()
    {
        $data = Classroom::where('deleted', false)->orderBy('id', 'desc')->paginate(9);
        $trash = Classroom::where('deleted', true)->get();
        return view('management.classrooms.classrooms', compact('data', 'trash'));
    }

    public function ClassAdd(Request $request)
    {
        $request->validate(
            [
                'classroom' => 'required|unique:classrooms',
            ],
            [
                'classroom.required' => 'ກະລຸນາປ້ອນຊື່ຫ້ອງຮຽນ',
                'classroom.unique' => 'ມີຊື່ຫ້ອງຮຽນນີ້ໃນລະບົບແລ້ວ',
            ]
        );

        // dd($request->all());
        $data = new Classroom;
        $data->classroom = $request->classroom;
        $data->description = $request->description;
        $data->save();

        $notification = array(
            'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ClassUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'classroom' => ['required', Rule::unique('Classrooms')->ignore($id)],
            ],
            [
                'classroom.required' => 'ກະລຸນາປ້ອນຊື່ຫ້ອງຮຽນ',
                'classroom.unique' => 'ມີຊື່ຫ້ອງຮຽນນີ້ໃນລະບົບແລ້ວ',
            ]
        );

        $class = Classroom::find($id);
        $class->classroom = $request->classroom;
        $class->description = $request->description;
        $class->save();

        $notification = array(
            'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->route('classroom.view')->with($notification);
    }

    public function ClassTrash()
    {
        $trash = Classroom::where('deleted', true)->paginate(9);
        return view('management.classrooms.classrooms_trash', compact('trash'));
    }

    public function ClassRemove($id)
    {
        $class = Classroom::find($id);
        $class->deleted = true;
        $class->save();

        $notification = array(
            'message' => 'ລຶບຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->route('classroom.view')->with($notification);
    }

    public function ClassRestore($id)
    {
        $class = Classroom::find($id);
        $class->deleted = false;
        $class->save();

        $notification = array(
            'message' => 'ກູ້ຄືນຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
