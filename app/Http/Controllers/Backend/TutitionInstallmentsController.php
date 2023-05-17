<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutitionInstallment;
use Illuminate\Support\Facades\Auth;

class TutitionInstallmentsController extends Controller
{
    public function InstallmentStore(Request $request)
    {
        $request->validate([
            'installment' => 'required|numeric|min:1',
            'amount' => 'required|numeric|min:1',
            'txt_amount' => 'required',
            'date' => 'required',
            'comment' => 'required'
        ], [
            'installment.required' => 'ກະລຸນາປ້ອນງວດທີຊຳລະ',
            'installment.numeric' => 'ກະລຸນາປ້ອນຕົວເລກເທົ່ານັ້ນ',
            'amount.required' => 'ກະລຸນາປ້ອນຈຳນວນເງິນ',
            'amount.numeric' => 'ກະລຸນາປ້ອນຕົວເລກເທົ່ານັ້ນ',
            'txt_amount.required' => 'ກະລຸນາປ້ອນຈຳນວນເງິນ (ຕົວອັກສອນ)',
            'date.required' => 'ກະລຸນາລະບຸວັນທີຊຳລະ',
            'comment.required' => 'ກະລຸນາລະບຸລາຍລະອຽດການຊຳລະ',
        ]);

        $data = new TutitionInstallment;
        $data->tutition_id = $request->tutition_id;
        $data->installment = $request->installment;
        $data->amount = $request->amount;
        $data->txt_amount = $request->txt_amount;
        $data->status = $request->status;
        $data->due_date = $request->date ? date('Y-m-d', strtotime($request->date)) : null;
        $data->comment = $request->comment;
        $data->modified_by = Auth::user()->id;
        $data->save();

        $notification = array(
            'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function InstallmentEdit($id)
    {
        $data = TutitionInstallment::find($id);
        return view('management.tutitions.installment_edit', compact('data'));
    }

    public function InstallmentUpdate(Request $request, $id)
    {
        $data = TutitionInstallment::find($id);
        $data->tutition_id = $request->tutition_id;
        $data->installment = $request->installment;
        $data->amount = $request->amount;
        $data->txt_amount = $request->txt_amount;
        $data->status = $request->status;
        $data->due_date = $request->due_date ? date('Y-m-d', strtotime($request->due_date)) : null;
        $data->comment = $request->comment;
        $data->modified_by = Auth::user()->id;
        $data->save();

        $notification = array(
            'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->route('tutition.detail', $data->tutition_id)->with($notification);

        // dd($request->all());
    }
}
