@push('js')
<script type="text/javascript">
	$('.datepicker').datepicker({
		rtl: "{{ session('lang') == 'ar' ? true : false}}",
		language: '{{ session("lang") }}',
		format: 'yyyy-mm-dd',
		autoclose: true,
		todayBtn: true,
		clearBtn: true,

	});

	$(document).on('change','.is_public', function(){
		var is_public = $('.is_public option:selected').val();
		if(is_public == 'no') {
			$('.reason').removeClass('hidden');
		} else {
			$('.reason').addClass('hidden');
		}
	});
</script>
@endpush
    <div id="item_setting" class="tab-pane fade">
      <h3> {{ trans('admin.item_setting') }} </h3>
      <div class="form-group col-ed-3 col-lg-3 col-sm-3 col-xs-12">
        {!! Form::label('price',trans('admin.item_price')) !!}
        {!! Form::text('price',$item->price, ['class' => 'form-control', 'placeholder' => trans('admin.item_price')]) !!}
      </div>
      
      <div class="form-group col-ed-3 col-lg-3 col-sm-3 col-xs-12">
        {!! Form::label('start_at',trans('admin.start_at')) !!}
        {!! Form::text('start_at',$item->start_at, ['class' => 'form-control datepicker', 'autocomplete' => 'off', 'placeholder' => trans('admin.start_at')]) !!}
      </div>
      <div class="form-group col-ed-3 col-lg-3 col-sm-3 col-xs-12">
        {!! Form::label('end_at',trans('admin.end_at')) !!}
        {!! Form::text('end_at',$item->end_at, ['class' => 'form-control datepicker', 'autocomplete' => 'off','placeholder' => trans('admin.end_at')]) !!}
      </div>
      <div class="clearfix"></div>

      <div class="form-group  col-ed-4 col-lg-4 col-sm-4 col-xs-12">
        {!! Form::label('price_offer',trans('admin.price_offer')) !!}
        {!! Form::text('price_offer',$item->price_offer, ['class' => 'form-control', 'placeholder' => trans('admin.price_offer')]) !!}
      </div>


      <div class="form-group col-ed-4 col-lg-4 col-sm-4 col-xs-12">
        {!! Form::label('start_offer_at',trans('admin.start_offer_at')) !!}
        {!! Form::text('start_offer_at',$item->start_offer_at, ['class' => 'form-control datepicker', 'autocomplete' => 'off', 'placeholder' => trans('admin.start_offer_at')]) !!}
      </div>
      <div class="form-group col-ed-4 col-lg-4 col-sm-4 col-xs-12">
        {!! Form::label('end_offer_at',trans('admin.end_offer_at')) !!}
        {!! Form::text('end_offer_at',$item->end_offer_at, ['class' => 'form-control datepicker', 'autocomplete' => 'off', 'placeholder' => trans('admin.end_offer_at')]) !!}
      </div>

      <div class="clearfix"></div>

      <div class="form-group">
        {!! Form::label('is_public',trans('admin.is_public')) !!}
        {!! Form::select('is_public',['yes' => trans('admin.yes'),'no' => trans('admin.no')], $item->is_public, ['class' => 'form-control is_public']) !!}
      </div>

      <div class="form-group reason {{ $item->is_public != 'no' ? 'hidden' : ''}}">
        {!! Form::label('reason',trans('admin.reason')) !!}
        {!! Form::textarea('reason',$item->reason, ['class' => 'form-control', 'placeholder' => trans('admin.reason')]) !!}
      </div>

    </div>
