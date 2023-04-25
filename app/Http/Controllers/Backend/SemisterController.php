<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semister;
use Illuminate\Validation\Rule;


class SemisterController extends Controller
{
    public function SemistersView()
    {
        $data = Semister::where('deleted', false)->orderBy('id', 'desc')->paginate(12);
        $trash = Semister::where('deleted', true)->count();
        return view('management.semisters.semisters', compact('data', 'trash'));
    }

    public function SemisterAdd(Request $request)
    {
        $request->validate(
            [
                'semister' => 'required|unique:semisters',
            ],
            [
                'semister.required' => 'ກະລຸນາປ້ອນເລກ ພາກ / ເທີມການສຶກສາ',
                'semister.unique' => 'ມີພາກ / ເທີມການສຶກສານີ້ໃນລະບົບແລ້ວ',
            ]
        );

        // dd($request->all());
        $semister = new Semister;
        $semister->semister = $request->semister;
        $semister->save();

        $notification = array(
            'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->route('semisters.view')->with($notification);

        // $input = $request->all();
        // dd($input);
    }

    public function SemisterUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'semister' => ['required', Rule::unique('semisters')->ignore($id)],
            ],
            [
                'semister.required' => 'ກະລຸນາປ້ອນເລກ ພາກ / ເທີມການສຶກສາ',
                'semister.unique' => 'ມີພາກ / ເທີມການສຶກສານີ້ໃນລະບົບແລ້ວ',
            ]
        );

        $semister = Semister::find($id);
        $semister->semister = $request->semister;
        $semister->save();

        $notification = array(
            'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->route('semisters.view')->with($notification);
    }

    public function SemisterRemove($id)
    {
        $semister = Semister::find($id);
        $semister->deleted = true;
        $semister->save();

        $notification = array(
            'message' => 'ລຶບຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->route('semisters.view')->with($notification);
    }

    public function SemistersTrash()
    {
        $semisterTrash = Semister::where('deleted', true)->paginate(9);
        return view('management.semisters.semisters_trash', compact('semisterTrash'));
    }

    public function SemisterRestore($id)
    {
        $semister = Semister::find($id);
        $semister->deleted = false;
        $semister->save();

        $notification = array(
            'message' => 'ກູ້ຄືນຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->route('semisters.trash')->with($notification);
    }
}
