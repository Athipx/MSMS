<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FeeType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FeeTypesController extends Controller
{
    public function FeeTypesView()
    {
        $data = FeeType::where('deleted', false)->orderBy('id', 'desc')->get();
        $trash = FeeType::where('deleted', true)->count();
        // $modified_by = $data->editor->fname_lo;
        return view('management.fees.types.feeType_view', compact('data', 'trash'));
    }

    public function FeeTypeStore(Request $request)
    {
        $request->validate(
            [
                'type' => 'required|unique:fee_types',
                'amount' => 'required|numeric|min:1',
                'txt_amount' => 'required',
            ],
            [
                'type.required' => 'ກະລຸນາລະບຸປະເພດຄ່າທຳນຽມ',
                'type.unique' => 'ມີປະເພດຄ່າທຳນຽມນີ້ໃນລະບົບແລ້ວ',
                'amount.required' => 'ກະລຸນາປ້ອນຈຳນວນເງິນ',
                'amount.numeric' => 'ກະລຸນາປ້ອນຕົວເລກເທົ່ານັ້ນ',
                'txt_amount.required' => 'ກະລຸນາປ້ອນຈຳນວນເງິນ (ຕົວອັກສອນ)',
            ]
        );

        $data = new FeeType;
        $data->type = $request->type;
        $data->amount = $request->amount;
        $data->txt_amount = $request->txt_amount;
        $data->description = $request->description;
        $data->save();

        $notification = array(
            'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function FeeTypeUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'type' => ['required', Rule::unique('fee_types')->ignore($id)],
                'amount' => 'required|numeric|min:1',
                'txt_amount' => 'required',
            ],
            [
                'type.required' => 'ກະລຸນາລະບຸປະເພດຄ່າທຳນຽມ',
                'type.unique' => 'ມີປະເພດຄ່າທຳນຽມນີ້ໃນລະບົບແລ້ວ',
                'amount.required' => 'ກະລຸນາປ້ອນຈຳນວນເງິນ',
                'amount.numeric' => 'ກະລຸນາປ້ອນຕົວເລກເທົ່ານັ້ນ',
                'txt_amount.required' => 'ກະລຸນາປ້ອນຈຳນວນເງິນ (ຕົວອັກສອນ)',
            ]
        );

        $data = FeeType::find($id);
        $data->type = $request->type;
        $data->amount = $request->amount;
        $data->txt_amount = $request->txt_amount;
        $data->description = $request->description;
        $data->save();

        $notification = array(
            'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function FeeTypeRemove($id)
    {
        $class = FeeType::find($id);
        $class->deleted = true;
        $class->save();

        $notification = array(
            'message' => 'ລຶບຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function FeeTypeTrash()
    {
        $trash = FeeType::where('deleted', true)->paginate(9);
        return view('management.fees.types.feeType_trash', compact('trash'));
    }

    public function FeeTypeRestore($id)
    {
        $class = FeeType::find($id);
        $class->deleted = false;
        $class->save();

        $notification = array(
            'message' => 'ກູ້ຄືນຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
