@extends('browse')

@section('title')
    Forgot Password - {{ $common['app'] }}
@stop

@section("content")
    <div class="row">
        <div class="col-lg-8 col-md-6 col-sm-12">
            <h2 class="text-warning no-padding">Forgot Your Password?</h2>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="login-box">
                <div class="login-box-body well well-md animated flipInX">

                    <p class="login-box-msg">Reset Password</p>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

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

                    <form class="" role="form" method="POST" action="{{ url('/password/email') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" placeholder="Email Address" name="email"
                                   value="{{ old('email') }}"
                                   autofocus=""/>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-lg-6 col-md-6">
                                <a href="{{ URL::to('/') }}/auth/login">Log In</a>
                            </div>
                            <div class="col-xs-6 col-lg-6 col-md-6">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">
                                    Send Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop