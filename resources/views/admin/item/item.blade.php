@extends('admin.index')
@section('content')

@push('js')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->
<script type="text/javascript">
  $(document).ready(function() {
    // $(".SelectMany").select2();
    $(document).on('click', '.save_and_continue', function(){
      var form_data = $('#item_form').serialize();
      $.ajax({
        url: '{{ aurl('item/'.$item->id) }}',
        dataType: 'json',
        type: 'post',
        data: form_data,
        beforeSend: function(){
          $('.loading_save_c').removeClass('hidden');
          $('.data_error').html('');          
          $('.error_message').addClass('hidden');
          $('.success_message').html('').addClass('hidden');
        }, success: function(data) {
          if(data.status == true){
            $('.loading_save_c').addClass('hidden');
            $('.success_message').html('<h1>' + data.message + '</h1>').removeClass('hidden');
          }  
        }, error: function(response){
          $('.loading_save_c').addClass('hidden');
          var error_li = '';
          $.each(response.responseJSON.errors, function(index, value){
            error_li += '<li>' + value + '</li>'
          });
          $('.data_error').html(error_li);
          $('.error_message').removeClass('hidden');
        }
      });
      return false;
    });

    $(document).on('click', '.save', function(){
      var form_data = $('#item_form').serialize();
      $.ajax({
        url: '{{ aurl('item/'.$item->id) }}',
        dataType: 'json',
        type: 'post',
        data: form_data,
        beforeSend: function() {
          $('.loading_save').removeClass('hidden');
          $('.data_error').html('');          
          $('.error_message').addClass('hidden');
          $('.success_message').html('').addClass('hidden');
        }, success: function(data) {
          if(data.status == true){
            $('.loading_save').addClass('hidden');
            window.location.href = '{{ aurl('item') }}';
            $('.success_message').html('<h1>' + data.message + '</h1>').removeClass('hidden');
          }  
        }, error: function(response) {
          $('.loading_save').addClass('hidden');
          var error_li = '';
          $.each(response.responseJSON.errors, function(index, value){
            error_li += '<li>' + value + '</li>'
          });
          $('.data_error').html(error_li);
          $('.error_message').removeClass('hidden');
        }
      });
      return false;
    });

    @if($item->menu_id)
      $.ajax({
          url: '{{ aurl("item/".$item->id."/edit") }}',
          type: 'get',
          dataType: 'html',
          data:   {
            menu_id:'{{ $item->menu_id }}', 
            select:'{{ $item->category_id }}'
          },
          success: function(data)
          {
            $('.category_id').html(data);
          },
        });
    @endif
    $(document).on('change','.menu_id', function(){
      var menu = $('.menu_id option:selected').val();
      if(menu > 0) {
        $.ajax({
          url: '{{ aurl("item/".$item->id."/edit") }}',
          type: 'get',
          dataType: 'html',
          data:   {
            menu_id: menu , 
            select: ''
          },
          success: function(data)
          {
            $('.category_id').html(data);
          },
        });
      } else {
          $('.category_id').html('');
      }
    });    

  });
</script>
@endpush

<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open(['route' => 'item.store', 'method' => 'put', 'files' => true, 'id' => 'item_form' ]) !!}
  <a href="#" class="btn btn-primary save"> {{ trans('admin.save') }} <i class="fa fa-floppy-o"></i> <i class="fa fa-spin fa-spinner loading_save hidden"></i> </a>
  <a href="#" class="btn btn-success save_and_continue"> {{ trans('admin.save_and_continue') }}<i class="fa fa-floppy-o"></i> <i class="fa fa-spin fa-spinner loading_save_c hidden"></i> 
  </a>
  <a href="#" class="btn btn-info copy"> {{ trans('admin.copy') }} <i class="fa fa-copy"></i></a>
  <a href="#" class="btn btn-danger delete"> {{ trans('admin.delete') }}<i class="fa fa-trash"></i> </a>      

  <hr/>
  <div class="alert alert-danger error_message hidden">
    <ul class="data_error">
      
    </ul>
  </div>
  <div class="alert alert-success success_message hidden">
    
  </div>
  <hr/>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#item_info"> {{ trans('admin.item_info') }} <i class="fa fa-info"></i> </a></li>
    <li><a data-toggle="tab" href="#item_setting"> {{ trans('admin.item_setting') }}<i class="fa fa-cog"></i> </a></li>
    <li><a data-toggle="tab" href="#item_media"> {{ trans('admin.item_media') }} <i class="fa fa-photo"></i></a></li>
    <li><a data-toggle="tab" href="#other_data"> {{ trans('admin.other_data') }} <i class="fa fa-database"></i> </a></li>
  </ul>
  
  <div class="tab-content">
    @include('admin.item.tabs.item_info')
    @include('admin.item.tabs.item_setting')
    @include('admin.item.tabs.item_media')
    @include('admin.item.tabs.other_data')                    
  </div>

  <hr/>
  <a href="#" class="btn btn-primary save"> {{ trans('admin.save') }} <i class="fa fa-floppy-o"></i> </a>
  <a href="#" class="btn btn-success save_and_continue"> {{ trans('admin.save_and_continue') }}<i class="fa fa-floppy-o"></i> <i class="fa fa-spin fa-spinner loading_save_c hidden"></i> </a>
  <a href="#" class="btn btn-info copy"> {{ trans('admin.copy') }} <i class="fa fa-copy"></i></a>
  <a href="#" class="btn btn-danger delete"> {{ trans('admin.delete') }}<i class="fa fa-trash"></i> </a>      

    {!! Form::close() !!}
  </div>
</div>

@endsection