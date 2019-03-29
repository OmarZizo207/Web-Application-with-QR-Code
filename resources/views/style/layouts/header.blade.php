<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ Storage::url(setting()->icon) }}" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>{{ lang() == 'ar' ? setting()->sitename_ar : setting()->sitename_en }}</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- Icon css link -->
        <!-- <link href="vendors/material-icon/css/materialdesignicons.min.css" rel="stylesheet"> -->
        <!-- <link href="css/font-awesome.min.css" rel="stylesheet"> -->
        <!-- <link href="vendors/linears-icon/style.css" rel="stylesheet"> -->
        
        <!-- Bootstrap -->
        <link href="{{ url('design/style') }}/css/bootstrap.min.css" rel="stylesheet">

        @stack('css')
        
        @if(lang() == 'ar')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
        @endif
        
        <!-- Extra plugin css -->
        <link href="{{ url('design/style') }}/vendors/bootstrap-selector/bootstrap-select.css" rel="stylesheet">
        <link href="{{ url('design/style') }}/vendors/bootatrap-date-time/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link href="{{ url('design/style') }}/vendors/owl-carousel/assets/owl.carousel.css" rel="stylesheet">
        
        <link href="{{ url('design/style') }}/css/style.css" rel="stylesheet">
        <link href="{{ url('design/style') }}/css/responsive.css" rel="stylesheet">
        <link href="{{ url('design/style') }}/css/shopping_cart.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
