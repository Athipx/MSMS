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
use App\Models\Student;
use App\Models\Thesis;
use App\Models\PresentationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ThesesController extends Controller
{
    public function getStudents(Request $request)
    {
        // $majors = Major::where('deleted', false)->get();
        // $gens = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();
        // $major = $request->input('major');
        // $generation = $request->input('generation');

        // $students = Student::with('major', 'gen')
        //     ->where('major_id', $major)
        //     ->Where('gen_id', $generation)
        //     ->get();

        // return view('management.theses.getStudents_result', compact('students', 'majors', 'gens'));

        $major_id = $request->major;
        $gen_id = $request->gen;
        $allData = Student::with('user', 'major', 'gen')
            ->where('major_id', $major_id)
            ->where('gen_id', $gen_id)
            ->get();

        return response()->json($allData);
    }

    public function ThesesView()
    {
        $theses = Thesis::all();
        return view('management.theses.theses_view', compact('theses'));
    }

    public function ThesisDetail($id)
    {
        $theses = Thesis::find($id);
        $teachers = Teacher::where('deleted', false)->get();
        $co_advisers = DB::table('thesis_advisers')
            ->select('users.*')
            ->join('teachers', 'thesis_advisers.teacher_id', 'teachers.id')
            ->join('users', 'teachers.user_id', 'users.id')
            ->where('thesis_advisers.thesis_id', $id)
            ->get();

        $logs = PresentationLog::where('thesis_id', $id)->get();

        $logIds = [];
        foreach ($logs as $log) {
            $logIds[] = $log->id;
        }

        return view('management.theses.thesis_detail', compact('theses', 'co_advisers', 'teachers', 'logs'));
    }


    public function ThesisAdd()
    {
        $students = Student::where('deleted', false)->get();
        $majors = Major::where('deleted', false)->get();
        $gens = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();
        $teachers = Teacher::where('deleted', false)->get();

        return view('management.theses.thesis_add', compact('students', 'majors', 'gens', 'teachers'));
    }

    public function ThesisStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title_lo' => 'required',
            'title_en' => 'required',
            'main_adviser' => 'required',
            'major' => 'required',
            'gen' => 'required',
        ], [
            'title_lo.required' => 'ກະລຸນາລະບຸຊື່ຫົວບົດ ພາສາລາວ',
            'title_en.required' => 'ກະລຸນາລະບຸຊື່ຫົວບົດ ພາສາອັງກິດ',
            'main_adviser.required' => 'ກະລຸນາເລືອກອາຈານທີ່ປຶກສາຫຼັກ',
            'major.required' => 'ກະລຸນາເລືອກສາຂາວິຊາ',
            'gen.required' => 'ກະລຸນາເລືອກຮຸ່ນການສຶກສາ',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (is_array($request->co_adviser)) {
            foreach ($request->co_adviser as $co_adviser) {
                if ($co_adviser !== $request->main_adviser) {
                    $data = new Thesis;
                    $data->title_lo = $request->title_lo;
                    $data->title_en = $request->title_en;
                    $data->student_id = $request->student;
                    $data->teacher_id = $request->main_adviser;
                    $data->major_id = $request->major;
                    $data->gen_id = $request->gen;
                    $data->description = $request->description;
                    $data->status = $request->status;
                    $data->modified_by = Auth::user()->id;
                    $data->save();

                    $co_advisers = $request->co_adviser;
                    $data->teachers()->sync($co_advisers);

                    $notification = array(
                        'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
                        'alert-type' => 'success'
                    );

                    return redirect()->route('theses.view')->with($notification);
                } else {
                    return redirect()->back()->withErrors('ອາຈານທີ່ປຶກສາຮ່ວມຊໍ້າກັນກັບອາຈານທີ່ປຶກສາຫຼັກ')->withInput();
                }
            }
        } else {
            $data = new Thesis;
            $data->title_lo = $request->title_lo;
            $data->title_en = $request->title_en;
            $data->student_id = $request->student;
            $data->teacher_id = $request->main_adviser;
            $data->major_id = $request->major;
            $data->gen_id = $request->gen;
            $data->description = $request->description;
            $data->status = $request->status;
            $data->modified_by = Auth::user()->id;
            $data->save();

            $notification = array(
                'message' => 'ເພີ່ມຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->route('theses.view')->with($notification);
        }
        // dd($request->all());
    }

    public function ThesisEdit($id)
    {
        $editData = Thesis::find($id);
        $teachers = Teacher::where('deleted', false)->get();
        $majors = Major::where('deleted', false)->get();
        $gens = Generation::where('deleted', false)->get();

        $co_advisers = DB::table('thesis_advisers')
            ->select('users.*')
            ->join('teachers', 'thesis_advisers.teacher_id', 'teachers.id')
            ->join('users', 'teachers.user_id', 'users.id')
            ->where('thesis_advisers.thesis_id', $id)
            ->get();

        $selectedTeacherIds = Thesis::find($id)->teachers->pluck('id')->toArray();

        return view('management.theses.thesis_edit', compact('editData', 'majors', 'gens', 'teachers', 'co_advisers', 'selectedTeacherIds'));
    }

    public function ThesisUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title_lo' => 'required',
            'title_en' => 'required',
            'main_adviser' => 'required',
            'major' => 'required',
            'gen' => 'required',
        ], [
            'title_lo.required' => 'ກະລຸນາລະບຸຊື່ຫົວບົດ ພາສາລາວ',
            'title_en.required' => 'ກະລຸນາລະບຸຊື່ຫົວບົດ ພາສາອັງກິດ',
            'main_adviser.required' => 'ກະລຸນາເລືອກອາຈານທີ່ປຶກສາຫຼັກ',
            'major.required' => 'ກະລຸນາເລືອກສາຂາວິຊາ',
            'gen.required' => 'ກະລຸນາເລືອກຮຸ່ນການສຶກສາ',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (is_array($request->co_adviser)) {
            foreach ($request->co_adviser as $co_adviser) {
                if ($co_adviser !== $request->main_adviser) {
                    $data = Thesis::find($id);
                    $data->title_lo = $request->title_lo;
                    $data->title_en = $request->title_en;
                    $data->student_id = $request->student ? $request->student : $request->old_student;
                    $data->teacher_id = $request->main_adviser;
                    $data->major_id = $request->major;
                    $data->gen_id = $request->gen;
                    $data->description = $request->description;
                    $data->status = $request->status;
                    $data->modified_by = Auth::user()->id;
                    $data->save();

                    $co_advisers = $request->co_adviser;
                    $data->teachers()->sync($co_advisers);

                    $notification = array(
                        'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
                        'alert-type' => 'success'
                    );

                    return redirect()->route('thesis.detail', $id)->with($notification);
                } else {
                    return redirect()->back()->withErrors('ອາຈານທີ່ປຶກສາຮ່ວມຊໍ້າກັນກັບອາຈານທີ່ປຶກສາຫຼັກ')->withInput();
                }
            }
        } else {
            $data = Thesis::find($id);
            $data->title_lo = $request->title_lo;
            $data->title_en = $request->title_en;
            $data->student_id = $request->student ? $request->student : $request->old_student;
            $data->teacher_id = $request->main_adviser;
            $data->major_id = $request->major;
            $data->gen_id = $request->gen;
            $data->description = $request->description;
            $data->status = $request->status;
            $data->modified_by = Auth::user()->id;
            $data->save();

            $co_advisers = $request->co_adviser;
            $data->teachers()->sync($co_advisers);

            $notification = array(
                'message' => 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
                'alert-type' => 'success'
            );

            return redirect()->route('thesis.detail', $id)->with($notification);
        }
    }
}
