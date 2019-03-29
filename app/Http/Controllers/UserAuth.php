<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Mail\UserResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use DB;
use Mail;

class UserAuth extends Controller
{

    public function logout()
    {
    	auth()->guard('web')->logout();
    	return redirect(url('login'));
    }

    public function forget_password()
    {
    	return view('auth.passwords.email');
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
    			'email'		=> $checkToken->email,
    			'password'	=> Hash::make(request('password'))
    		]);
    		DB::table('password_resets')->where('email', request('email'))->delete();
    		auth()->guard('web')->attempt(['email' => $checkToken->email, 'password' => request('password')], true);
    		return redirect(url('/'));
    	} else {
    		return redirect(url('login'));
    	}	
    }
}
