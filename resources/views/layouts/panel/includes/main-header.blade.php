<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">{{ config('app.name') }}</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{{ config('app.name') }}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">2</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">پیام های شما</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">

                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-right">
                                            <img src="#" class="img-circle" alt="User Image">
                                        </div>
                                        <h4>
                                            {{--بخش IT--}}
                                            <small><i class="fa fa-clock-o"></i> روز گذشته</small>
                                        </h4>
                                        <p class="success">ارسال کننده: </p>
                                        <p>عنوان: </p>
                                    </a>
                                </li>
                                <!-- end message -->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">مشاهده همه پیام ها</a></li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{route('avatar.show',Auth::user()->avatar)}}" alt="" class="user-image img-responsive">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{route('avatar.show',Auth::user()->avatar)}}" alt="" class="img-circle img-responsive">
                            <p>
                                {{ Auth::user()->name }}
                                <small dir="rtl">عضویت:<br>{{ substr(\Morilog\Jalali\Jalalian::fromDateTime(Auth::user()->created_at),0,10)}}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a class="btn btn-danger btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">خروج</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>

                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
