<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Generation;
use Illuminate\Validation\Rule;

class GenerationController extends Controller
{
    public function GenView()
    {
        $data = Generation::where('deleted', false)->orderBy('id', 'desc')->paginate(9);
        $trash = Generation::where('deleted', true)->get();
        return view('management.generations.generations', compact('data', 'trash'));
    }

    public function GenAdd(Request $request)
    {
        $request->validate(
            [
                'gen' => 'required|unique:generations|numeric',
                'description' => 'alpha',
            ],
            [
                'gen.required' => 'ກະລຸນາປ້ອນເລກຮຸ່ນ',
                'gen.unique' => 'ມີເລກຮຸ່ນນີ້ໃນລະບົບແລ້ວ',
                'gen.numeric' => 'ປ້ອນໄດ້ສະເພາະຕົວເລກເທົ່ານັ້ນ',
                'description.alpha' => 'ຫ້າມໃສ່ຕົວອັກສອນພິເສດໃນລາຍລະອຽດ'
            ]
        );

        // dd($request->all());
        $gen = new Generation;
        $gen->gen = $request->gen;
        $gen->description = $request->description;
        $gen->save();

        $notification = array(
            'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->route('gen.view')->with($notification);
    }

    public function GenUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'gen' => ['required', Rule::unique('generations')->ignore($id), 'numeric'],
                'description' => 'alpha',
            ],
            [
                'gen.required' => 'ກະລຸນາປ້ອນເລກຮຸ່ນ',
                'gen.unique' => 'ມີເລກຮຸ່ນນີ້ໃນລະບົບແລ້ວ',
                'gen.numeric' => 'ປ້ອນໄດ້ສະເພາະຕົວເລກເທົ່ານັ້ນ',
                'description.alpha' => 'ຫ້າມໃສ່ຕົວອັກສອນພິເສດໃນລາຍລະອຽດ'
            ]
        );

        $gen = Generation::find($id);
        $gen->gen = $request->gen;
        $gen->description = $request->description;
        $gen->save();

        $notification = array(
            'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->route('gen.view')->with($notification);
    }

    public function GenTrash()
    {
        $trash = Generation::where('deleted', true)->paginate(9);
        return view('management.generations.gen_trash', compact('trash'));
    }

    public function GenRemove($id)
    {
        $gen = Generation::find($id);
        $gen->deleted = true;
        $gen->save();

        $notification = array(
            'message' => 'ລຶບຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->route('gen.view')->with($notification);
    }

    public function GenRestore($id)
    {
        $gen = Generation::find($id);
        $gen->deleted = false;
        $gen->save();

        $notification = array(
            'message' => 'ກູ້ຄືນຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->route('gen.view')->with($notification);
    }
}
