<?php


Route::group(['middleware' => 'Maintenance'], function(){
	
	Route::get('/', function () {
		return view('style.home');
	});

	Route::get('about', function () {
	    return view('style.about');
	});

	Route::get('contact-us', function () {
	    return view('style.contact');
	});

    Route::get('signup', 'Auth\RegisterController@RegisterForm')->name('signup');
    Route::post('signup', 'Auth\RegisterController@CreateUser');

    Route::get('login', 'Auth\LoginController@LoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@DoLogin');

    Route::get('restaurants', 'HomeController@ShowRestaurants');
    Route::get('restaurants/{id}', 'HomeController@ShowMenu');
    Route::post('restaurants/{id}', 'HomeController@ShowMenu');

    Route::get('forget/password', 'Auth\ForgotPasswordController@showLinkRequestForm');
	Route::post('forget/password', 'UserAuth@forget_password_post')->name('forget/password');
	
	Route::get('reset/password/{token}', 'Auth\ResetPasswordController@reset_password');
	Route::post('reset/password/{token}', 'Auth\ResetPasswordController@reset_password_final');

	Route::group(['middleware' => 'auth'], function(){
	
	    Route::any('logout', 'Auth\LoginController@logout');

        Route::post('add_to_cart/{id}','HomeController@add_cart');

        Route::post('remove_cart/{id}', 'HomeController@remove_cart');

        Route::get('checkout', 'HomeController@show_checkout');

        Route::get('check_qr', 'HomeController@read_qrcode');

    });
});

Route::get('lang/{lang}', function($lang){
	session()->has('lang') ? session()->forget('lang') : '';
	$lang == 'ar' ? session()->put('lang','ar') : session()->put('lang','en');
	return back();
});

Route::get('maintenance', function(){
	if(setting()->status == 'open') {
            return redirect('/');
        }
	return view('style.maintenance');
});
