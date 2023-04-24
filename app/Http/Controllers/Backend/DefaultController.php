<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Generation;
use App\Models\Major;
use App\Models\Subject;
use App\Models\Assign;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class DefaultController extends Controller
{
    public function GetSubjects(Request $request)
    {
        $gen_id = $request->gen_id;
        $allData = Assign::with('subject')->where('gen_id', $gen_id)->get();
        return response()->json($allData);
    }
}
