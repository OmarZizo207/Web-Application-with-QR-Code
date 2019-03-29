@include('admin.layouts.header')
@include('admin.layouts.navbar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ trans('admin.dashboard') }}
        <small>{{ trans('admin.control_panel') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> {{ trans('admin.home') }} </a></li>
        <li class="active"> {{ trans('admin.dashboard') }} </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    	@include('admin.layouts.message')
    	@yield('content')
    </section>
    <!-- /.content -->
  </div>

@include('admin.layouts.footer')