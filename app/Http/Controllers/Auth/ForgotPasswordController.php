<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use App\Mail\UserResetPassword;
use Illuminate\Http\Request;
use App\User;
use DB;
use Carbon\Carbon;
use Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function forget_password_post()
    {
        $user = User::where('email', request('email'))->first();
        if(!empty($user)) {
            $token = app('auth.password.broker')->createToken($user);
            $data  = DB::table('password_resets')->insert([
                'email'         => $user->email,
                'token'         => $token,
                'created_at'    => Carbon::now(),
            ]);
            Mail::to($user->email)->send(new UserResetPassword(['data' => $user, 'token' => $token]));
            session()->flash('success', trans('user.the_link_reset_sent').trans('user.please_check_your_mail'));
            return back();
        }
        session()->flash('failed', trans('user.the_email_not_found'));
        return back();
    }

}
