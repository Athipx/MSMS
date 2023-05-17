<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'login' => 'required',
            'password' => 'required',
        ]);

        $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (auth()->attempt(array($loginType => $input['login'], 'password' => $input['password'], 'status' => 'active'), $request->has('remember'))) {
            if (auth()->user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if (auth()->user()->role == 'teacher') {
                return redirect()->route('teacher.dashboard');
            } else if (auth()->user()->role == 'coordinator') {
                return redirect()->route('coordinator.dashboard');
            } else if (auth()->user()->role == 'headUnit') {
                return redirect()->route('headUnit.dashboard');
            } else if (auth()->user()->role == 'headDept') {
                return redirect()->route('headDept.dashboard');
            } else {
                return redirect()->route('student.dashboard');
            }
        } else {
            $user = User::where($loginType, $input['login'])->first();
            if ($user && $user->status != 'active') {
                return redirect()->route('login')->with('error', 'ບັນຊີນີ້ຖືກປິດການໃຊ້ງານ. ກະລຸນາພົວພັນພາກສ່ວນກ່ຽວຂ້ອງ.');
            } else {
                return redirect()->route('login')->with('error', 'ອີເມວ ຫຼື ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ.');
            }
        }
    }
}
