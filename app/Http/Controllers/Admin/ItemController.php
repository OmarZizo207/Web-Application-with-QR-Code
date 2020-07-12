<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ItemDatatable;

use Illuminate\Http\Request;
use App\Model\Item;
use App\Model\Category;
use App\Model\OtherData;
use App\File;
use Storage;
use Form;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ItemDatatable $admin)
    {
        return $admin->render('admin.item.index',['title'=> trans('admin.products')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Item::create([
            'title'         => '',
        ]);

        if(!empty($item)) {
            return redirect(aurl('item/'. $item->id . '/edit'));
        }
    }

    public function delete_main_image($id)
    {
        $item = Item::find($id);
        Storage::delete($item->photo);
        $item->photo = null;
        $item->save();
    }

    public function update_item_image($id)
    {
        $item = Item::where('id', $id)->update([
            'photo' => up()->upload([
                'file'          => 'file',
                'path'          => 'items/' . $id,
                'upload_type'   => 'single',
                'delete_file'   => '',
            ]),
        ]);
        return response(['status' => true],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = $this->validate(request(),[
            'title'                 => 'sometimes|nullable',
        ], [],[
            'title'                 => trans('admin.title'),
        ]);

        Item::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('item'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax()) {
            if (request()->has('menu_id')) {
                $select = request()->has('select') ? request('select') : '';
                return Form::select('category_id', Category::where('menu_id', request('menu_id'))->pluck('name_'.session('lang'), 'id') , $select, ['class' => 'form-control','placeholder' => trans('admin.choose_category')]);
            }
        }
        $item = Item::find($id);
        return view('admin.item.item',['title' => trans('admin.create_or_edit_item',
            ['title' => $item->title]),
            'item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function upload_file($id)
    {
        if(request()->hasFile('file')) {
            $fid = up()->upload([
                'file'          => 'file',
                'path'          => 'items/' . $id,
                'upload_type'   => 'files',
                'file_type'     => 'item',
                'relation_id'   => $id,
            ]);
            return response(['status' => true, 'id' => $fid], 200);
        }
    }

    public function delete_file()
    {
        if(request()->has('id')) {
            up()->delete_f(request('id'));
        }
    }


    public function update($id)
    {
        $data = $this->validate(request(),[
            'title'                 => 'required',
            'content'               => 'sometimes|nullable',
            'description'           => 'sometimes|nullable',
            'restaurant_id'         => 'required|numeric',
            'menu_id'               => 'required|numeric',
            'category_id'           => 'required|numeric',
            'photo'                 => 'sometimes|nullable'.validate_image(),
            'price'                 => 'sometimes|nullable|numeric',
            'start_at'              => 'sometimes|nullable|date|before:end_at',
            'end_at'                => 'sometimes|nullable|date|after:start_at',
            'price_offer'           => 'sometimes|nullable|numeric',
            'start_offer_at'        => 'sometimes|nullable|date|after:start_at',
            'end_offer_at'          => 'sometimes|nullable|date|before:end_at|after:start_offer_at',
            'calories'              => 'sometimes|nullable|numeric',
            'is_public'             => 'sometimes|nullable|in:yes,no',
            'reason'                => 'sometimes|nullable',
            'other_data'            => 'sometimes|nullable'
        ], [],[
            'title'                 => trans('admin.title'),
            'content'               => trans('admin.content'),
            'description'           => trans('admin.description'),
            'restaurant_id'         => trans('restaurant_name_'.lang()),
            'menu_id'               => trans('menu_name_'.lang()),
            'category_id'           => trans('admin.category_id'),
            'photo'                 => trans('admin.photo'),
            'price'                 => trans('admin.price'),
            'start_at'              => trans('admin.start_at'),
            'end_at'                => trans('admin.end_at'),
            'price_offer'           => trans('admin.price_offer'),
            'start_offer_at'        => trans('admin.start_offer_at'),
            'end_offer_at'          => trans('admin.end_offer_at'),
            'calories'              => trans('admin.calories'),
            'is_public'             => trans('admin.is_public'),
            'reason'                => trans('admin.reason'),
            'other_data'            => trans('admin.other_data'),
        ]);
        if(request()->has('input_key') && request()->has('input_value')) {
            $i = 0;
            $other_data = '';
            OtherData::where('item_id' , $id)->delete();
            foreach(request('input_key') as $key) {
                $data_value = !empty(request('input_value')[$i]) ? request('input_value')[$i] : '';
                OtherData::create([
                    'item_id'       => $id,
                    'data_key'      => $key,
                    'data_value'    => $data_value,
                ]);
                $i++;
            }
            // $data['other_data'] = rtrim($other_data, '|');
        }

        Item::where('id', $id)->update($data);
        return response(['status' => true,'message' => trans('admin.record_updated')], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = Item::find($id);
        /* This Delete is temp until find another solution */
        $first_path = explode('/', $items->photo);
        $all_path = $first_path[0].'/'.$first_path[1];
        Storage::deleteDirectory($all_path);
        /* This Delete is temp until find another solution */
        $items->delete();
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('item'));
    }

    public function multi_delete()
    {
        if(is_array(request('item'))) {
            foreach(request('item') as $id) {
                $items = Item::find($id);
                /* This Delete is temp until find another solution */
                $first_path = explode('/', $items->photo);
                $all_path = $first_path[0].'/'.$first_path[1];
                Storage::deleteDirectory($all_path);
                /* This Delete is temp until find another solution */
                // Storage::delete($items->photo);
                $items->delete();
            }
        } else {
            $items = Item::find(request('item'));
            /* This Delete is temp until find another solution */
            $first_path = explode('/', $items->photo);
            $all_path = $first_path[0].'/'.$first_path[1];
            Storage::deleteDirectory($all_path);
            /* This Delete is temp until find another solution */
            // Storage::delete($items->photo);
            $items->delete();
        }
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('item'));
    }

}
