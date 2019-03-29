    <div id="item_info" class="tab-pane fade in active">
      <h3> {{ trans('admin.item_info') }} </h3>
      <div class="form-group">
        {!! Form::label('title',trans('admin.item_title')) !!}
        {!! Form::text('title',$item->title, ['class' => 'form-control', 'placeholder' => trans('admin.item_title')]) !!}
      </div>
      <div class="form-group">
        {!! Form::label('content',trans('admin.item_content')) !!}
        {!! Form::text('content',$item->content, ['class' => 'form-control', 'placeholder' => trans('admin.item_content')]) !!}
      </div>
      <div class="form-group">
        {!! Form::label('restaurant_id',trans('admin.restaurant_name')) !!}
        {!! Form::select('restaurant_id',App\Model\Restaurants::pluck('restaurant_name_'.session('lang'), 'id'), $item->restaurant_id, ['class'=>'form-control','placeholder' => trans('admin.choose_restaurant')]) !!}
      </div> 
      <div class="form-group">
        {!! Form::label('menu_id',trans('admin.menu_name')) !!}
        {!! Form::select('menu_id',App\Model\Menu::pluck('menu_name_'.session('lang'), 'id'), $item->menu_id, ['class'=>'form-control menu_id','placeholder'=>trans('admin.choose_menu')]) !!}
      </div>
      <div class="form-group">
        {!! Form::label('category_id',trans('admin.category_name')) !!}
        <span class="category_id"></span>
      </div>
      <div class="form-group">
        {!! Form::label('description',trans('admin.item_description')) !!}
        {!! Form::textarea('description',$item->description, ['class' => 'form-control', 'placeholder' => trans('admin.item_content')]) !!}
      </div>

    </div>