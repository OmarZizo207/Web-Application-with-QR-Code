@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
<script type="text/javascript">

Dropzone.autoDiscover = false;
	$(document).ready(function(){
		$('#dropzonefileupload').dropzone({
			url: '{{ aurl("upload/image/" . $item->id) }}',
			paramName:'file',
			autoDiscover: false,
			uploadMultiple:false,
			maxFiles:15,
			maxFilessize: 3,
			acceptedFiles: 'image/*',
			dictDefaultMessage: '{{ trans("admin.click_to_upload") }}',
			dictRemoveFile: '<button class="btn btn-danger"> <i class="fa fa-trash"></i></button>',
			params: {
				_token: '{{ csrf_token() }}'
			},
			addRemoveLinks:true,
			removedfile: function(file)
			{
				$.ajax({
					dataType: 'json',
					type: 'post',
					url:'{{ aurl("delete/image") }}',
					data:{
						_token: '{{ csrf_token() }}',
						id: file.fid,
					}
				});
			var fmock;
			return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement): void 0;
			},
			init: function(){
				@foreach($item->files()->get() as $file)
					var mock = {
						name: '{{ $file->name }}',
						fid:'{{ $file->id }}',
						size: '{{ $file->size }}',
						type: '{{ $file->mime_type }}',
					};
				this.emit('addedfile',mock);
				this.options.thumbnail.call(this,mock,'{{ url("storage/" .$file->full_file) }}');
				$('.dz-progress').remove();
				@endforeach

				this.on('sending', function(file, xhr, formData){
					formData.append('fid','');
					file.fid = '';
				});

				this.on('success', function(file, response){
					file.fid = response.id;
				});

			}
		});

		$('#mainphoto').dropzone({
			url: '{{ aurl("update/image/" . $item->id) }}',
			paramName:'file',
			autoDiscover: false,

			uploadMultiple:false,
			maxFiles:1,
			maxFilessize: 3,
			acceptedFiles: 'image/*',
			dictDefaultMessage: '{{ trans("admin.upload_main_photo") }}',
			dictRemoveFile: '<button class="btn btn-danger"> <i class="fa fa-trash"></i></button>',
			params: {
				_token: '{{ csrf_token() }}'
			},
			addRemoveLinks:true,
			removedfile: function(file)
			{
				$.ajax({
					dataType: 'json',
					type: 'post',
					url:'{{ aurl("delete/item/image/".$item->id) }}',
					data:{
						_token: '{{ csrf_token() }}',
					}
				});
			var fmock;
			return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement): void 0;
			},
			init: function(){

				@if(!empty($item->photo))
				var mock = { name: '{{ $item->title }}', size: '', type: ''};
				this.emit('addedfile',mock);
				this.options.thumbnail.call(this,mock,'{{ url("storage/".$item->photo) }}');
				$('.dz-progress').remove();
				@endif

				this.on('sending', function(file, xhr, formData){
					formData.append('fid','');
					file.fid = '';
				});

				this.on('success', function(file, response){
					file.fid = response.id;
				});

			}
		});
	});
</script>
<style type="text/css">
	.dz-image img {
		width: 100px;
		height: 100px;
	}
	#mainphoto {
		width: 200px;
		height: 205px;
		min-height: 0px !important;
	}
</style>
@endpush
    <div id="item_media" class="tab-pane fade">
      <h3> {{ trans('admin.item_media') }} </h3>
      <hr/>
      <h3> {{ trans('admin.main_photo') }} </h3>
      <div class="dropzone" id="mainphoto"></div>
      <hr/>
      <center> <h3> {{ trans('admin.other_files') }} </h3> </center>
      <div class="dropzone" id="dropzonefileupload"></div>
    </div>
