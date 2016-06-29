<!-- Main Header -->
<header class="main-header">

    <a href="{{ URL::to('/admin') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>{{ $common['appShort'] }}</b></span>
        <span class="logo-lg"><b>{{ $common['app'] }}</b> Portal</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->


                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">

                    @if (session('error'))
                            <p class="bg-info" style="margin: 10px; padding: 5px;">
                                <span class="text-warning"><i class="fa fa-warning"></i> {{ session('error') }}</span>
                            </p>

                    @endif
                    <!-- Menu toggle button -->

                    {{--<ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                <li><!-- start notification -->
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li><!-- end notification -->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>--}}
                </li>



                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ URL::to('/assets/img/user-admin.png') }}" class="user-image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->getFullName() }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ URL::to('/assets/img/user-admin.png') }}" class="img-circle" alt="User Image" />
                            <p>
                                {{ Auth::user()->getFullName() }}
                                <small>Member since <strong>{{ Auth::user()->created_at->format(' d M Y') }}</strong></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ URL::to('/') }}/my-profile"
                                   class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-left">
                                <a href="{{ URL::to('/') }}/change-password"
                                   class="btn btn-default btn-flat">Change Password</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ URL::to('/') }}/auth/logout"
                                   class="btn btn-default btn-flat">Log out</a>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
