<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assign;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Major;
use App\Models\Generation;
use App\Models\Semister;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AssignsController extends Controller
{
    public function GetSubjects(Request $request)
    {
        $major_id = $request->major_id;

        $subjects = DB::table('subject_major')
            ->select('subjects.subject', 'subjects.id')
            ->join('subjects', 'subject_major.subject_id', 'subjects.id')
            ->join('majors', 'subject_major.major_id', 'majors.id')
            ->where('majors.id', $major_id)
            ->where('subjects.deleted', false)
            ->get();

        return response()->json($subjects);
    }


    public function AssignsView(Request $request)
    {
        $trash = Assign::where('deleted', true)->count();
        $teacher = Teacher::where('deleted', false)->get();
        $subject = Subject::where('deleted', false)->get();
        $major = Major::where('deleted', false)->get();
        $classroom = Classroom::where('deleted', false)->get();
        $gen = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();
        $semister = Semister::where('deleted', false)->get();

        $major_id = $request->major_id;
        $gen_id = $request->gen_id;

        // $data = Assign::where('deleted', false)->get();

        $data = Assign::select('id', 'subject_id', 'gen_id', 'major_id', 'semister_id', 'classroom_id')
            ->with(['subject', 'gen', 'major', 'semister', 'classroom'])
            ->when($major_id, function ($query, $major_id) {
                return $query->where('major_id', $major_id);
            })
            ->when($gen_id, function ($query, $gen_id) {
                return $query->where('gen_id', $gen_id);
            })
            ->where('deleted', false)
            ->get();


        return view('management.assigns.assigns_view', compact('data', 'teacher', 'subject', 'major', 'gen', 'semister', 'classroom', 'trash', 'major_id', 'gen_id'));
    }

    public function AssignDetail($id)
    {
        $data = Assign::find($id);

        $teachers = DB::table('assigns')
            ->select('users.*')
            ->join('teacher_assigns', 'teacher_assigns.assign_id', 'assigns.id')
            ->join('teachers', 'teacher_assigns.teacher_id', 'teachers.id')
            ->join('users', 'teachers.user_id', 'users.id')
            ->where('assigns.id', $id)
            ->get();

        return view('management.assigns.assign_detail', compact('data', 'teachers'));

        // $teachers = DB::select('SELECT users.fname_lo AS user_name
        //     FROM assigns JOIN teacher_assigns ON assigns.id = teacher_assigns.assign_id JOIN teachers ON teacher_assigns.teacher_id = teachers.id JOIN users ON teachers.user_id = users.id
        //     WHERE assigns.id = ?', [$id]);

        // return view('management.assigns.assign_detail', ['data' => $data, 'teachers' => $teachers]);
    }

    public function AssignAdd()
    {
        $teacher = Teacher::where('deleted', false)->get();
        $subject = Subject::where('deleted', false)->get();
        $major = Major::where('deleted', false)->get();
        $classroom = Classroom::where('deleted', false)->get();
        $gen = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();
        $semister = Semister::where('deleted', false)->get();
        return view('management.assigns.assign_add', compact('teacher', 'subject', 'major', 'gen', 'semister', 'classroom'));
    }

    public function AssignStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hours' => 'required|numeric',
            'major' => 'required',
            'gen' => 'required',
            'subject' => 'required',
            'semister' => 'required',
            'teacher' => 'required',
        ], [
            'hours.required' => 'Please enter the number of hours.',
            'hours.numeric' => 'Please enter a valid number.',
            'major.required' => 'ກະລຸນາເລືອກ ສາຂາວິຊາ.',
            'gen.required' => 'ກະລຸນາເລືອກ ຮຸ່ນການສຶກສາ.',
            'subject.required' => 'ກະລຸນາເລືອກ ວິຊາ.',
            'semister.required' => 'ກະລຸນາເລືອກ ພາກຮຽນ.',
            'teacher.required' => 'ກະລຸນາເລືອກ ອາຈານສອນ.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $assign = new Assign;
        $assign->subject_id = $request->subject;
        $assign->major_id = $request->major;
        $assign->gen_id = $request->gen;
        $assign->semister_id = $request->semister;
        $assign->classroom_id = $request->classroom;
        $assign->hours = $request->hours;
        $assign->description = $request->description;
        $assign->save();

        $teachers = $request->teacher;
        $assign->teachers_mm()->sync($teachers);

        $notification = array(
            'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->route('assigns.view')->with($notification);
    }

    public function AssignEdit($id)
    {
        $editData = Assign::with('teacher')->find($id);
        $teacher = Teacher::where('deleted', false)->get();
        $subject = Subject::where('deleted', false)->get();
        $major = Major::where('deleted', false)->get();
        $classroom = Classroom::where('deleted', false)->get();
        $gen = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();
        $semister = Semister::where('deleted', false)->get();

        // $assign = Assign::find($id)
        $selectedTeacherIds = Assign::find($id)->teachers_mm->pluck('id')->toArray();

        return view('management.assigns.assign_edit', compact('teacher', 'subject', 'major', 'gen', 'semister', 'classroom', 'editData', 'selectedTeacherIds'));
    }

    public function AssignUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'hours' => 'required|numeric',
            'major' => 'required',
            'gen' => 'required',
            'semister' => 'required',
            'teacher' => 'required',
        ], [
            'hours.required' => 'Please enter the number of hours.',
            'hours.numeric' => 'Please enter a valid number.',
            'major.required' => 'ກະລຸນາເລືອກ ສາຂາວິຊາ.',
            'gen.required' => 'ກະລຸນາເລືອກ ຮຸ່ນການສຶກສາ.',
            'semister.required' => 'ກະລຸນາເລືອກ ພາກຮຽນ.',
            'teacher.required' => 'ກະລຸນາເລືອກ ອາຈານສອນ.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->subject == '') {
            $assign = Assign::find($id);
            $assign->subject_id = $request->old_subject;
            $assign->major_id = $request->major;
            $assign->gen_id = $request->gen;
            $assign->semister_id = $request->semister;
            $assign->classroom_id = $request->classroom;
            $assign->hours = $request->hours;
            $assign->description = $request->description;
            $assign->save();

            $teachers = $request->teacher;
            $assign->teachers_mm()->sync($teachers);
        } else {
            $assign = Assign::find($id);
            $assign->subject_id = $request->subject;
            $assign->major_id = $request->major;
            $assign->gen_id = $request->gen;
            $assign->semister_id = $request->semister;
            $assign->classroom_id = $request->classroom;
            $assign->hours = $request->hours;
            $assign->description = $request->description;
            $assign->save();

            $teachers = $request->teacher;
            $assign->teachers_mm()->sync($teachers);
        }

        $notification = array(
            'message' => 'ໄຂຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        // dd($request->all());
    }

    public function AssignRemove($id)
    {
        $assign = Assign::find($id);
        $assign->deleted = true;
        $assign->modified_by = Auth::user()->id;
        $assign->save();

        $notification = array(
            'message' => 'ລຶບຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->route('assigns.view')->with($notification);
    }

    public function AssignsTrash()
    {
        $data = Assign::where('deleted', true)->with('teacher')->get();
        return view('management.assigns.assigns_trash', compact('data'));
    }

    public function AssignRestore($id)
    {
        $assign = Assign::find($id);
        $assign->deleted = false;
        $assign->modified_by = Auth::user()->id;
        $assign->save();

        $notification = array(
            'message' => 'ກູ້ຄືນຂໍ້ມູນສຳເລັດ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
