<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Student;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname_lo' => ['required', 'string', 'max:255'],
            'lname_lo' => ['required', 'string', 'max:255'],
            'fname_en' => ['required', 'string', 'max:255'],
            'lname_en' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /** 
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     User::create([
    //         'fname_lo' => $data['fname_lo'],
    //         'lname_lo' => $data['lname_lo'],
    //         'fname_en' => $data['fname_en'],
    //         'lname_en' => $data['lname_en'],
    //         'username' => $data['username'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'role' => 'student',
    //         'status' => 'active'
    //     ]);

    //     return redirect()->route('login');
    // }

    public function RegisterStore(Request $request)
    {
        $user = new User;
        $user->fname_lo = $request->fname_lo;
        $user->lname_lo = $request->lname_lo;
        $user->fname_en = $request->fname_en;
        $user->lname_en = $request->lname_en;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'student';
        $user->status = 'active';
        $user->save();

        $data = new Student;
        $data->user_id = $user->id;
        $data->major_id = $request->major_id;
        $data->gen_id = $request->gen_id;
        $data->save();

        return redirect()->route('login')->with('success', 'ລົງທະບຽນສຳເລັດ');
    }
}
