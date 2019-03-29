         <!--================End Footer Area =================-->
        <header class="main_menu_area">
            <nav class="navbar navbar-default">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <i class="fas fa-bar"></i>
                        </button>
                        <a class="navbar-brand" href="#"><img src="img/logo-1.png" alt=""></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="{{ url('') }}">Home</a></li>
                            <li class="active"><a href="{{ url('restaurants') }}">Restaurants</a></li>
                            <li class="active"><a href="{{ url('about') }}">About US</a></li>
                            <li class="active"><a href="{{ url('contact-us') }}">Contact US</a></li>            

                            @if(Auth::check())
                            <li><a href="{{ url('logout') }}"><i class="fas fa-sign-in-alt"></i> Logout </a></li>
                            @else
                            <li class="dropdown submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">"><i class="fas fa-sign-in-alt"></i>Login or Sign UP<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('login') }}">Login</a></li>
                                    <li><a href="{{ url('login') }}">Signup</a></li>
                                </ul>
                            </li>
                            @endif                            

                            <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                            <li class="dropdown submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-globe"></i> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('lang/ar') }}"><i class="fa fa-flag"></i>عربي</a></li>
                                    <li><a href="{{ url('lang/en') }}"><i class="fa fa-flag"></i>English</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>
        <!--================End Footer Area =================-->