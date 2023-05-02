<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\Teacher;
use App\Models\PresentationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThesisPresentationController extends Controller
{
    public function PresentLogStore(Request $request)
    {
        $request->validate([
            'round' => 'required|numeric|min:1',
            'committees' => 'required',
            'date' => 'required',
            'comment' => 'required'
        ], [
            'round.required' => 'ກະລຸນາປ້ອນຄັ້ງທີປ້ອງກັນ',
            'round.numeric' => 'ກະລຸນາປ້ອນຕົວເລກເທົ່ານັ້ນ',
            'committee.required' => 'ກະລຸນາລະບຸຄະນະກຳມະການ',
            'date.required' => 'ກະລຸນາລະບຸວັນທີປ້ອງກັນ',
            'comment.required' => 'ກະລຸນາລະບຸຄຳເຫັນຈາກຄະນະກຳມະການ',
        ]);

        $data = new PresentationLog;
        $data->thesis_id = $request->thesis_id;
        $data->round = $request->round;
        $data->type = $request->type;
        $data->date = $request->date ? date('Y-m-d', strtotime($request->date)) : null;
        $data->status = $request->status;
        $data->comment = $request->comment;
        $data->save();

        $committees = $request->committees;
        $data->teachers()->sync($committees);


        $checkProposalPass = PresentationLog::where('thesis_id', $request->thesis_id)
            ->where('type', 'proposal')
            ->where('status', 'pass')
            ->count();

        $checkThesisPass = PresentationLog::where('thesis_id', $request->thesis_id)
            ->where('type', 'thesis')
            ->where('status', 'pass')
            ->count();

        if ($checkProposalPass != 0 && $checkThesisPass != 0) {
            $updateData = Thesis::find($request->thesis_id);
            $updateData->status = 'pass';
            $updateData->save();
        }

        $notification = array(
            'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function PresentLogDetail($id)
    {
        $data = PresentationLog::find($id);
        $committees = DB::table('committees')
            ->select('users.fname_lo as name')
            ->join('teachers', 'committees.teacher_id', 'teachers.id')
            ->join('users', 'teachers.user_id', 'users.id')
            ->where('committees.presentation_log_id', $id)
            ->get();
        return view('management.theses.presentation_detail', compact('data', 'committees'));
    }

    public function PresentLogEdit($id)
    {
        $data = PresentationLog::find($id);
        $teachers = Teacher::where('deleted', false)->get();
        $selectedTeacherIds = PresentationLog::find($id)->teachers->pluck('id')->toArray();
        return view('management.theses.presentation_edit', compact('data', 'teachers', 'selectedTeacherIds'));
    }

    public function PresentLogUpdate(Request $request, $id)
    {
        $data = PresentationLog::find($id);
        $data->thesis_id = $request->thesis_id;
        $data->round = $request->round;
        $data->type = $request->type;
        $data->date = $request->date ? date('Y-m-d', strtotime($request->date)) : null;
        $data->status = $request->status;
        $data->comment = $request->comment;
        $data->save();

        $committees = $request->committees;
        $data->teachers()->sync($committees);

        $notification = array(
            'message' => 'ແກ້ຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
