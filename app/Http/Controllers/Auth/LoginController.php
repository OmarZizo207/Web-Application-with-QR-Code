<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function LoginForm()
    {
        return view('auth.login');
    }

    public function DoLogin(Request $request)
    {
         $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        $rememberme = request('rememberme') == 1 ? true : false;
        
        if(Auth::guard()->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
            return redirect('/');
        } else {
            session()->flash('error', trans('admin.incorrect_info_login'));
            return redirect( url('login'));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect( url('login') );
    }
}
