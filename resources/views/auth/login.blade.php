@extends('browse')

@section('title')
    Login - {{ $common['app'] }}
@stop

@section("content")
    <div class="row">
        <div class="col-lg-8 col-md-6 col-sm-12">

        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="login-box well well-lg">
                <div class="login-box-body animated flipInX">
                    <p class="login-box-msg">Sign in to start your session</p>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="" role="form" method="POST" action="{{ url('/auth/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="type" value="member">
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"
                                   autofocus=""/>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" placeholder="Password" name="password"/>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">
                                <a href="{{ URL::to('/') }}/password/email">Forgot Password?</a>
                            </div>
                            <div class="col-xs-4">
                                <button type="submit" value="signin" class="btn btn-primary btn-block btn-flat">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop