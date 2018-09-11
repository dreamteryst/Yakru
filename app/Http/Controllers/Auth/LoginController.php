<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

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
        //Validate request
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //Attempt login
        if (Auth::ttempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return json_encode(['success' => true, 'message' => 'เข้าสู่ระบบสำเร็จ']);
        }
        return json_encode(['success' => false, 'message' => 'Email หรือ Password ผิดพลาด']);
    }
}
