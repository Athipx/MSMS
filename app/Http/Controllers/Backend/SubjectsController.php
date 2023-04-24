<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class SubjectsController extends Controller
{
    public function SubjectsView(Request $request)
    {
        $data = Subject::where('deleted', false)->orderBy('id', 'desc')->paginate(9);
        $trash = Subject::where('deleted', true)->count();
        $majors = Major::where('deleted', false)->get();

        foreach ($data as $major) {
            $subject_major = DB::table('subject_major')
                ->select('majors.major as major')
                ->join('majors', 'subject_major.major_id', 'majors.id')
                ->join('subjects', 'subject_major.subject_id', 'subjects.id')
                ->where('subject_major.subject_id', $major->id)
                ->get();

            $major->subject_major = $subject_major;
        }

        return view('management.subjects.subjects', compact('data', 'trash', 'majors'));

        // $major_id = $request->input('major_id');

        // $select_subject = DB::table('subjects')
        //     ->join('majors', 'subjects.major_id', '=', 'majors.id')
        //     ->select('subjects.id as id', 'subjects.subject_id as subject_id', 'subjects.subject as subject', 'subjects.credit as credit', 'majors.major as major')
        //     ->where('subjects.deleted', false);

        // if ($major_id) {
        //     $select_subject->where('majors.id', $major_id);
        // }

        // $data = $select_subject->paginate(10); // 10 records per page
        // $major = Major::all();
        // $trash = Subject::where('deleted', true)->count();

        // return view('management.subjects.subjects', compact('data', 'trash'));
    }

    public function SubjectAdd(Request $request)
    {
        $request->validate(
            [
                'subject' => 'required|unique:subjects',
                'subject_id' => 'required|unique:subjects',
                'credit' => 'required|numeric',
            ],
            [
                'subject.required' => 'ກະລຸນາປ້ອນຊື່ຫ້ອງຮຽນ',
                'subject.unique' => 'ມີຊື່ຫ້ອງຮຽນນີ້ໃນລະບົບແລ້ວ',
                'credit.required' => 'ກະລຸນາປ້ອນຈຳນວນໜ່ວຍກິດ',
                'credit.numeric' => 'ກະລຸນາປ້ອນໂຕເລກເທົ່ານັ້ນ',
                'subject_id.required' => 'ກະລຸນາປ້ອນລະຫັດວິຊາ',
                'subject_id.unique' => 'ມີລະຫັດວິຊານີ້ໃນລະບົບແລ້ວ',
            ]
        );

        // dd($request->all());
        $subject = new Subject;
        $subject->subject_id = $request->subject_id;
        $subject->subject = $request->subject;
        $subject->description = $request->description;
        $subject->credit = $request->credit;
        $subject->save();

        $majors = $request->major;
        $subject->majors()->sync($majors);

        $notification = array(
            'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->route('subjects.view')->with($notification);
    }

    public function SubjectEdit($id)
    {
        $editData = Subject::find($id);
        $majors = Major::where('deleted', false)->get();

        $selectedMajorIds = Subject::find($id)->majors->pluck('id')->toArray();

        return view('management.subjects.subject_edit', compact('editData', 'majors', 'selectedMajorIds'));
    }

    public function SubjectUpdate(Request $request, $id)
    {

        $request->validate(
            [
                // 'subject' => [
                //     'required',
                //     Rule::unique('subjects')->where(function ($query) use ($request) {
                //         return $query->where('major_id', $request->major);
                //     })->ignore($id),
                // ],
                'subject' => ['required', Rule::unique('subjects')->ignore($id),],
                'subject_id' => ['required', Rule::unique('subjects')->ignore($id),],
                'credit' => 'required|numeric',
            ],
            [
                'subject.required' => 'ກະລຸນາປ້ອນຊື່ຫ້ອງຮຽນ',
                'subject.unique' => 'ມີຊື່ຫ້ອງຮຽນນີ້ໃນລະບົບແລ້ວ',
                'credit.required' => 'ກະລຸນາປ້ອນຈຳນວນໜ່ວຍກິດ',
                'credit.numeric' => 'ກະລຸນາປ້ອນໂຕເລກເທົ່ານັ້ນ',
                'subject_id.required' => 'ກະລຸນາປ້ອນລະຫັດວິຊາ',
                'subject_id.unique' => 'ມີລະຫັດວິຊານີ້ໃນລະບົບແລ້ວ',
            ]
        );

        $subject = Subject::find($id);
        $subject->subject_id = $request->subject_id;
        $subject->subject = $request->subject;
        $subject->description = $request->description;
        $subject->credit = $request->credit;
        $subject->save();

        $majors = $request->major;
        $subject->majors()->sync($majors);

        $notification = array(
            'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function SubjectsTrash()
    {
        $trash = Subject::where('deleted', true)->paginate(9);
        return view('management.subjects.subjects_trash', compact('trash'));
    }

    public function SubjectRemove($id)
    {
        $class = Subject::find($id);
        $class->deleted = true;
        $class->save();

        $notification = array(
            'message' => 'ລຶບຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->route('subjects.view')->with($notification);
    }

    public function SubjectRestore($id)
    {
        $class = Subject::find($id);
        $class->deleted = false;
        $class->save();

        $notification = array(
            'message' => 'ກູ້ຄືນຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // public function SubjectFilter(Request $request)
    // {
    //     $major_id = $request->input('major_id');

    //     $select_subject = DB::table('subjects')
    //         ->join('majors', 'subjects.major_id', '=', 'majors.id')
    //         ->select('subjects.id as id', 'subjects.subject as subject', 'subjects.credit as credit', 'majors.major as major')
    //         ->where('subjects.deleted', false);

    //     if ($major_id) {
    //         $select_subject->where('majors.id', $major_id);
    //     }

    //     $data = $select_subject->paginate(10); // 10 records per page
    //     $major = Major::all();

    //     return view('management.subjects.subjects2', compact('data', 'major'));
    // }
}
