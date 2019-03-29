@push('js')
<script type="text/javascript">
	var x = 1;
	$(document).on('click', '.add_input', function(){
		var max_input = 10;
		if(x < max_input) {
			$('.input_tag').append(
				'<div>' +
	      			'<div class="col-md-6">'+
	      				'{!! Form::label('input_key', trans('admin.input_key')) !!}'+
	      				'{!! Form::text('input_key[]', '', ['class' => 'form-control']) !!}'+
	      			'</div>'+
	      			'<div class="col-md-6">'+
	      				'{!! Form::label('input_value', trans('admin.input_value')) !!}'+
	      				'{!! Form::text('input_value[]', '', ['class' => 'form-control']) !!}'+
	      			'</div>'+
	      			'<div class="clearfix"></div>'+
	      			'<br>'+
	      			'<a href="#" class="remove_input btn btn-danger"> <i class="fa fa-trash"></i> </a>'+
      			'</div>');
			x++;
		}
		if(x > max_input || x == max_input) {
			$('.add_input').hide();
		} else {
			$('.add_input').show();
		}
		return false;
	});
	$(document).on('click', '.remove_input', function(){
		$(this).parent('div').remove();
		x--;
		$('.add_input').show();
		return false;
	});
</script>
@endpush
    <div id="other_data" class="tab-pane fade">
      <h3> {{ trans('admin.other_data') }} </h3>
      <div class="input_tag col-md-12 col-lg-12 col-sm-12">
      	@foreach($item->other_data()->get() as $other)
      	<div>
	      	<div class="col-md-6">
	      		{!! Form::label('input_key', trans('admin.input_key')) !!}
	      		{!! Form::text('input_key[]', $other->data_key, ['class' => 'form-control']) !!}
	      	</div>
	      	<div class="col-md-6">
	      		{!! Form::label('input_value', trans('admin.input_value')) !!}
	      		{!! Form::text('input_value[]', $other->data_value, ['class' => 'form-control']) !!}
	      	</div>
	      	<div class="clearfix"></div>
	      	<br>
	      	<a href="#" class="remove_input btn btn-danger"> <i class="fa fa-trash"></i> </a>
      	</div>
      	@endforeach
      </div>
      <div class="clearfix"></div>
      <br>
      <a href="#" class="add_input btn btn-info"> <i class="fa fa-plus"></i> </a>
      <div class="clearfix"></div>
      <br>
    </div>    
