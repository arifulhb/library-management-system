<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">{{ $common['app'] }}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}"><i class="fa fa-book"></i> Browse</a>
                </li>
                {{--<li><a href="#"><i class="fa fa-language"></i> Authors</a></li>
                <li><a href="#"><i class="fa fa-building-o"></i> Publishers</a></li>--}}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ Request::is('borrow-books') ? 'active' : '' }}">
                    <a href="{{ url('/').'/borrow-books' }}">
                        <i class="fa fa-shopping-cart"></i> <span class="text-primary">Borrow</span></a>
                </li>
                @if(Auth::guest())
                    <li><a href="{{ url('/').'/auth/register' }}">Register</a></li>
                    <li class="{{ Request::is('auth/login') ? 'active' : '' }}">
                        <a href="{{ url('/').'/auth/login' }}">Login</a>
                    </li>
                @else

                    <li class="{{ Request::is('return-books') ? 'active' : '' }}">
                        <a href="{{ url('/').'/return-books' }}"><i class="fa fa-keyboard-o "></i> Return</a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                         aria-expanded="false"><i class="fa fa-user text-info"></i> {{ Auth::user()->getFullName() }} <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                              <li class="dropdown-header">Account</li>
                              <li><a href="{{ url('/').'/my-profile' }}">Profile</a></li>
                              <li><a href="{{ url('/').'/change-password' }}">Change Password</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="{{ url('/') .'/auth/logout' }}">Log out</a></li>
                          </ul>
                  </li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>