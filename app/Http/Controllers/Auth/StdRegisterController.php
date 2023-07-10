<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\Generation;

class StdRegisterController extends Controller
{
    public function RegisterForm()
    {
        // $majors = Major::where('deleted', false)->get();
        // $gens = Generation::where('deleted', false)->orderBy('id', 'DESC')->get();
        // return view('auth.register', compact('majors, gens'));

        $gen = Generation::all();
        $major = Major::all();

        return view('auth.register', compact('major', 'gen'));
    }
}
