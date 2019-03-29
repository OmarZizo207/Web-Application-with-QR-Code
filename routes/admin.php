<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){

	Config::set('auth.defines','admin'); 

	Route::get('login', 'AdminAuth@login');
	Route::post('login', 'AdminAuth@dologin');
	Route::get('forgot/password', 'AdminAuth@forgot_password');
	Route::post('forgot/password', 'AdminAuth@forgot_password_post');
	Route::get('reset/password/{token}', 'AdminAuth@reset_password');
	Route::post('reset/password/{token}', 'AdminAuth@reset_password_final');
		
	Route::group(['middleware' => 'admin:admin'], function(){
		
		Route::get('/', function () {
			return view('admin.home');
		});

		Route::resource('admin','AdminController');
		Route::delete('admin/destroy/all','AdminController@multi_delete');

		Route::resource('users','UsersController');
		Route::delete('users/destroy/all','UsersController@multi_delete');		

		Route::get('settings','Settings@setting');
		Route::post('settings','Settings@setting_save');		

		Route::resource('restaurants','RestaurantsController');
		Route::delete('restaurants/destroy/all','RestaurantsController@multi_delete');

		Route::resource('employee','EmployeeController');
		Route::delete('employee/destroy/all','EmployeeController@multi_delete');

		Route::resource('menu','MenusController');
		Route::delete('menu/destroy/all','MenusController@multi_delete');

		Route::resource('category','CategoryController');
		Route::delete('category/destroy/all','CategoryController@multi_delete');

		Route::resource('tables','TableController');
		Route::delete('tables/destroy/all','TableController@multi_delete');

		Route::resource('item','ItemController');
		Route::delete('item/destroy/all','ItemController@multi_delete');
		Route::post('upload/image/{pid}','ItemController@upload_file');		
		Route::post('delete/image', 'ItemController@delete_file');
		Route::post('update/image/{pid}', 'ItemController@update_item_image');
		Route::post('delete/item/image/{pid}', 'ItemController@delete_main_image');

		Route::any('logout', 'AdminAuth@logout');

	});

	Route::get('lang/{lang}', function($lang){
		session()->has('lang') ? session()->forget('lang') : '';
		$lang == 'ar' ? session()->put('lang','ar') : session()->put('lang','en');
		return back();
	});
});