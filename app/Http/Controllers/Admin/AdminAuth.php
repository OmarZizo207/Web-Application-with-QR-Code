<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Admin;
use App\Mail\AdminResetPassword;
use DB;
use Carbon\Carbon;
use Mail;

class AdminAuth extends Controller
{
    public function login()
    {
    	return view('admin.login');
    }

    public function dologin()
    {
    	$rememberme = request('rememberme') == 1 ? true : false;
    	if(admin()->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
    		return redirect('admin');
    	} else {
    		session()->flash('error', trans('admin.incorrect_info_login'));
    		return redirect(aurl('login'));
    	}
    }

    public function logout()
    {
    	auth()->guard('admin')->logout();
    	return redirect(aurl('login'));
    }

    public function forgot_password()
    {
    	return view('admin.forgot_password');
    }

    public function forgot_password_post()
    {
    	$admin = Admin::where('email', request('email'))->first();
    	if(!empty($admin)) {
    		$token = app('auth.password.broker')->createToken($admin);
    		$data  = DB::table('password_resets')->insert([
    			'email' 		=> $admin->email,
    			'token' 		=> $token,
    			'created_at' 	=> Carbon::now(),
    		]);
    		Mail::to($admin->email)->send(new AdminResetPassword(['data' => $admin, 'token' => $token]));
    		session()->flash('success', trans('admin.the_link_reset_sent'));
    		return back();
    	}
    	// session()->flash('failed', trans('admin.the_email_bot_found'));
    	return back();
    }

    public function reset_password($token)
    {
    	$checkToken = DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
    	if(!empty($checkToken)) {
    		return view('admin.reset_password',['data' => $checkToken]);
    	} else {
    		session()->flash('failed',trans('admin.the_email_bot_found'));
    		return redirect(aurl('forgot/password'));
    	}
    }

    public function reset_password_final($token)
    {
    	$this->validate(request(),[
    		'password'                => 'required|confirmed',
    		'password_confirmation'   => 'required',
    	],[],[
    		'password'                => 'Password',
    		'password_confirmation'   => 'Confirmation Password'
    	]);
    	$checkToken = DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
    	if(!empty($checkToken)) {
    		$admin = Admin::where('email', $checkToken->email)->update([
    			'email'		=> $checkToken->email,
    			'password'	=> bcrypt(request('password'))
    		]);
    		DB::table('password_resets')->where('email', request('email'))->delete();
    		admin()->attempt(['email' => $checkToken->email, 'password' => request('password')], true);
    		return redirect(aurl());
    	} else {
    		return redirect(aurl('login'));
    	}
    }
}
