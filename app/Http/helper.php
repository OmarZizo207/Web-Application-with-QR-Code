<?php

if(!function_exists('setting')) {
    function setting() {
        return \App\Model\Setting::orderBy('id', 'desc')->first();
    }
}

if(!function_exists('restaurants')) {
    function restaurants() {
        return \App\Model\Restaurants::orderBy('id', 'desc')->first();
    }
}

if(!function_exists('employee')) {
    function employee() {
        return \App\Model\Employee::orderBy('id', 'desc')->first();
    }
}

if(!function_exists('menu')) {
    function menu() {
        return \App\Model\Menu::orderBy('id', 'desc')->first();
    }
}

if(!function_exists('up')) {
    function up() {
        return new \App\Http\Controllers\Upload;
    }
}

if(!function_exists('load_dep')) {
    function load_dep($select = null, $dep_hide = null) {
        $departments = \App\Model\Department::selectRaw('dep_name_'.session('lang').' as text')
        ->selectRaw('id as id')
        ->selectRaw('parent as parent')
        ->get(['text','parent','id']);
        $dep_arr = [];
        foreach ($departments as $department) {
            $list_arr = [];
            $list_arr['icon']       = '';
            $list_arr['li_attr']    = '';
            $list_arr['a_attr']     = '';
            $list_arr['children']   = '';
            if($select !== null and $select == $department->id) {

                $list_arr['state']      = [
                    'opened'    => true,
                    'disabled'  => false,
                    'selected'  => true,
                ];
            }
            if($dep_hide !== null and $dep_hide == $department->id) {

                $list_arr['state']      = [
                    'opened'    => false,
                    'disabled'  => true,
                    'selected'  => false,
                    'hidden'    => true,
                ];
            }
            $list_arr['id']     = $department->id;
            $list_arr['parent'] = $department->parent !== null ? $department->parent : '#';
            $list_arr['text']   = $department->text;
            array_push($dep_arr,$list_arr);
        }
        return json_encode($dep_arr,JSON_UNESCAPED_UNICODE);
    }
}

if(!function_exists('get_parent')) {
    function get_parent($dep_id) {
        $deparment_list = [];
        $department = \App\Model\Department::find($dep_id);
        if($department->parent != null && $department->parent > 0) {
            return $dep_id . ',' . get_parent($department->parent);
        } else {
            return $dep_id;
        }
    }
}


if(!function_exists('aurl')) {
	function aurl($url = null)
	{
		return url('admin/'.$url);
	}
}

if(!function_exists('admin')){
	function admin()
	{
		return auth()->guard('admin');
	}
}

if(!function_exists('active_menu')){
    function active_menu($link)
    {
        if(preg_match('/'.$link.'/i',Request::segment(2))) {
            return ['menu-open','display:block'];
        } else {
            return ['',''];
        }
    }
}

if(!function_exists('active_nav')){
    function active_nav($link)
    {
        if(preg_match('/'.$link.'/i',Request::segment(1))) {
            return ['active'];
        } else {
            return [''];
        }
    }
}

if(!function_exists('lang')){
	function lang()
	{
		if(session()->has('lang')) {
            return session('lang');
        } else {
            session()->put('lang', setting()->main_lang);
            return setting()->main_lang;
        }
	}
}

if(!function_exists('Ldir')){
	function Ldir()
	{
		if(session()->has('lang')) {
            if (session('lang') == 'ar') {
            	return 'rtl';
            } else {
            	return 'ltr';
            }
        } else {
            return 'ltr';
        }
	}
}

if(!function_exists('datatable_lang')){
	function datatable_lang()
	{
		return [
			"sProcessing"           => trans('admin.sProcessing'),
            "sLengthMenu"           => trans('admin.sLengthMenu'),
            "sZeroRecords"          => trans('admin.sZeroRecords'),
            "sEmptyTable"           => trans('admin.sEmptyTable'),
            "sInfo"                 => trans('admin.sInfo'),
            "sInfoEmpty"            => trans('admin.sInfoEmpty'),
            "sInfoFiltered"         => trans('admin.sInfoFiltered'),
            "sInfoPostFix"          => trans('admin.sInfoPostFix'),
            "sSearch"               => trans('admin.sSearch'),
            "sUrl"                  => trans('admin.sUrl'),
            "sInfoThousands"        => trans('admin.sInfoThousands'),
            "sLoadingRecords"       => trans('admin.sLoadingRecords'),
            "oPaginate" => [
                "sFirst"            => trans('admin.sFirst'),
                "sLast"             => trans('admin.sLast'),
                "sNext"             => trans('admin.sNext'),
                "sPrevious"         => trans('admin.sPrevious')
            ],
            "oAria" => [
                "sSortAscending"    => trans('admin.sSortAscending'),
                "sSortDescending"   => trans('admin.sSortDescending')
            ],
		];
	}
}

if(!function_exists('validate_image')) {
    function validate_image($ext = null)
    {
        if($ext === null) {
            return 'image|mimes:jpg,jpeg,png,gif,bmp';
        } else {
            return 'image|mimes:'.$ext;
        }
    }
}

if(!function_exists('show_items')) {
    function show_items($restaurant_id)
    {
        if($restaurant_id === null) {
            return '<h2>'. trans('user.restaurant') .'</h2>';
        } else {
            $categories = App\Model\Category::where('restaurant_id', $restaurant_id);
            $items = App\Model\Item::where('restaurant_id', $restaurant_id);
            return $categories;
        }
    }
}

if(!function_exists('item_price')) {
    function item_price($item_id)
    {
        $items = App\Model\Item::where('id', $item_id)->get();
        foreach ($items as $item) {
            return $item->price;
        }
    }
}

if(!function_exists('item_details')) {
    function item_details($item_id)
    {
        $items = App\Model\Item::where('id', $item_id)->get();
        foreach ($items as $item) {
            return $item;
        }
    }
}
