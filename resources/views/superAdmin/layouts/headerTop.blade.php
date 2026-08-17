<header class="main-header" style="background-color: #303748 !important;">
    <!-- Logo -->
    <a href="" class="logo" style="background-color: #303748 !important;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>مليار</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>مليار </b> كلمة</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation" style="background-color: #303748;">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"> </span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('includesAdmin/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs"> {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header"  style="background-color: #303748 !important;">
                            <img src="{{ asset('includesAdmin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                            <p>
                                {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-12 text-center">
                                <a href="#">مرحبا بك </a>
                            </div>


                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="#" class="btn btn-default btn-flat">حسابك</a>
                            </div>
                            <div class="pull-left">
                                <a href="{{route('logout')}}" class="btn btn-default btn-flat">تسجيل الخروج
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->

            </ul>
        </div>
    </nav>
</header>