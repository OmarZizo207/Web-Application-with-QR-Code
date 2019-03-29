<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Setting;
use Storage;
use Up;

class Settings extends Controller {

	public function setting() 
	{
		return view('admin.settings', ['title' => trans('admin.settings')]);
	}

	public function setting_save() 
	{
		$data = $this->validate(request(), [
				'logo' 					=> validate_image(), 
				'icon' 					=> validate_image(),
				'status'				=> '',
				'keyword'				=> '',
				'description'			=> '',
				'main_lang'				=> '',
				'message_maintenance'	=> '',
				'email'					=> '',
				'sitename_en'			=> '',
				'sitename_ar'			=> '',
			] ,[], [
				'logo'					=> trans('admin.logo'),
				'icon'					=> trans('admin.icon'),
				'status'				=> trans('admin.website_status'),
				'keyword'				=> trans('admin.website_keyword'),
				'description'			=> trans('admin.website_description'),
		]);
		
		if(request()->hasFile('logo')) {
			
			$data['logo'] = up()->upload([
				// 'new_name'		=> '',
				'file'			=> 'logo',
				'path'			=> 'settings',
				'upload_type'	=> 'single',
				'delete_file'	=> setting()->logo,
				
			]);//request()->file('logo')->store('settings')
		}

		if(request()->hasFile('icon')) {
			
			$data['icon'] = up()->upload([
				// 'new_name'		=> '',
				'file'			=> 'icon',
				'path'			=> 'settings',
				'upload_type'	=> 'single',
				'delete_file'	=> setting()->icon,
				
			]);
		}		
		Setting::orderBy('id', 'desc')->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('settings'));
	}
}