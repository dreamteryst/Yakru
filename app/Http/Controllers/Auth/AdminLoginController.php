<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
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
        $this->middleware('guest:web_admin')->except('logout');
    }

    public function login(Request $request)
    {
        //Validate request
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //Attempt login
        if (Auth::guard('web_admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return response('Login sucess', 200);
        }
        return response('Email or password incorrect!', 422);
    }
}
