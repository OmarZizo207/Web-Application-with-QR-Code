
  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <i class="fas fa-bars"></i>
        <span class="sr-only">Toggle navigation</span>
      </a>

      @include('admin.layouts.menu')
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ url('/design/AdminLTE') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> {{ admin()->user()->name }} </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="{{ trans('admin.search') }}">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"> {{ trans('admin.main_navigation') }} </li>
        <li class="treeview">
          <a href="{{ aurl('') }}">
            <i class="fas fa-tachometer-alt"></i> <span> {{ trans('admin.dashboard') }} </span>
            <span class="pull-right-container">
<!--               <i class="fa fa-angle-left pull-right"></i> -->
            </span>
          </a>
          
        </li>

        <li class="treeview {{ active_menu('admin')[0] }}">
          <a href="#">
            <i class="fa fa-users"></i> <span>{{ trans('admin.admin') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('admin')[1] }}">
            <li class="active"><a href="{{ aurl('admin') }}"><i class="fa fa-user-lock"></i> {{ trans('admin.admin_accounts') }}</a></li>
          </ul>
        </li>

        <li class="treeview {{ active_menu('users')[0] }}">
          <a href="#">
            <i class="fa fa-users"></i> <span>{{ trans('admin.users') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('users_accounts')[1] }}">
            <li class="active"><a href="{{ aurl('users') }}"><i class="fa fa-user-circle"></i> {{ trans('admin.users_accounts') }}</a></li>
            <li class=""><a href="{{ aurl('users') }}?level=user"><i class="fa fa-user"></i> {{ trans('admin.users') }}</a></li>
            <li class=""><a href="{{ aurl('users') }}?level=shops"><i class="fa fa-industry"></i> {{ trans('admin.shops') }}</a></li>
            <li class=""><a href="{{ aurl('users') }}?level=company"><i class="fa fa-building"></i> {{ trans('admin.company') }}</a></li>
          </ul>
        </li>

        <li class="treeview {{ active_menu('settings')[0] }}">
          <a href="#">
            <i class="fa fa-cog"></i> <span>{{ trans('admin.settings') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('settings')[1] }}">
            <li class="active"><a href="{{ aurl('settings') }}"><i class="fa fa-wrench" aria-hidden="true"></i> {{ trans('admin.website_settings') }}</a></li>
          </ul>
        </li>
        
        <li class="treeview {{ active_menu('restaurants')[0] }}">
          <a href="#">
            <i class="fas fa-utensils"></i> <span>{{ trans('admin.restaurants') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('restaurants')[1] }}">
            <li class="active"><a href="{{ aurl('restaurants') }}"><i class="fas fa-utensils" aria-hidden="true"></i> {{ trans('admin.restaurants') }}</a></li>
            <li class="active"><a href="{{ aurl('restaurants/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>

        <li class="treeview {{ active_menu('tables')[0] }}">
          <a href="#">
            <i class="fas fa-table"></i> <span>{{ trans('admin.tables') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('tables')[1] }}">
            <li class="active"><a href="{{ aurl('tables') }}"><i class="fas fa-table" aria-hidden="true"></i> {{ trans('admin.tables') }}</a></li>
            <li class="active"><a href="{{ aurl('tables/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>

        <li class="treeview {{ active_menu('employee')[0] }}">
          <a href="#">
            <i class="fa fa-user-cog"></i> <span>{{ trans('admin.employee') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('employee')[1] }}">
            <li class="active"><a href="{{ aurl('employee') }}"><i class="fa fa-user-cog" aria-hidden="true"></i> {{ trans('admin.employee') }}</a></li>
            <li class="active"><a href="{{ aurl('employee/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>

        <li class="treeview {{ active_menu('menu')[0] }}">
          <a href="#">
            <i class="fa fa-book-reader"></i> <span>{{ trans('admin.menu') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('menu')[1] }}">
            <li class="active"><a href="{{ aurl('menu') }}"><i class="fa fa-book-reader" aria-hidden="true"></i> {{ trans('admin.menu') }}</a></li>
            <li class="active"><a href="{{ aurl('menu/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>

        <li class="treeview {{ active_menu('category')[0] }}">
          <a href="#">
            <i class="fa fa-code-branch"></i> <span>{{ trans('admin.category') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('category')[1] }}">
            <li class="active"><a href="{{ aurl('category') }}"><i class="fa fa-code-branch" aria-hidden="true"></i> {{ trans('admin.category') }}</a></li>
            <li class="active"><a href="{{ aurl('category/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>

        <li class="treeview {{ active_menu('item')[0] }}">
          <a href="#">
            <i class="fas fa-cookie-bite"></i> <span>{{ trans('admin.items') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('item')[1] }}">
            <li class="active"><a href="{{ aurl('item') }}"><i class="fas fa-cookie-bite" aria-hidden="true"></i> {{ trans('admin.items') }}</a></li>
            <li class="active"><a href="{{ aurl('item/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> {{ trans('admin.add') }}</a></li>
          </ul>
        </li>

        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
