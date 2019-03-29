<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }

    public function reset_password($token)
    {
        $checkToken = DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($checkToken)) {
            return view('auth.passwords.reset',['data' => $checkToken]);
        } else {
            session()->flash('failed',trans('user.the_email_bot_found'));
            return redirect(url('forget/password'));
        }
    }

    public function reset_password_final($token)
    {
        $this->validate(request(),[
            'password'                => 'required|confirmed',
            'password_confirmation'   => 'required',
        ],[],[
            'password'                => trans('user.password'),
            'password_confirmation'   => trans('user.password_confirm')
        ]);
        $checkToken = DB::table('password_resets')->where('token', $token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($checkToken)) {
            $user = User::where('email', $checkToken->email)->update([
                'email'     => $checkToken->email,
                'password'  => Hash::make(request('password'))
            ]);
            DB::table('password_resets')->where('email', request('email'))->delete();
            auth()->guard('web')->attempt(['email' => $checkToken->email, 'password' => request('password')], true);
            return redirect(url('/'));
        } else {
            return redirect(url('login'));
        }   
    }

}
