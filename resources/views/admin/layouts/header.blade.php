<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ !empty($title) ? $title : trans('admin.admin_panel') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  @if(Ldir() == 'ltr')
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/dist/css/AdminLTE.min.css">
  @else
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/dist/css/rtl/AdminLTE.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/dist/css/rtl/bootstrap-rtl.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/dist/css/rtl/rtl.css">
  <link href="https://fonts.googleapis.com/css?family=Cairo:400,600&amp;subset=arabic,latin-ext" rel="stylesheet">
  <style type="text/css">
    html,body,.alert,h1,h2,h3,h4,h5 {
      font-family: 'Cairo', sans-serif;
    }
  </style> 
  @endif
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('design/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/jstree/themes/default/style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" type="text/css" href="{{ url('/') }}/design/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
