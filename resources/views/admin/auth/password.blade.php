<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ appTitle()  }} | Reset Password</title>
    <meta content="Lightspeed Restaurant Reporting app" name="description">
    <meta content="Ariful Haque <http://www.arifulhaque.com>" name="author">
    <link rel="author" href="https://plus.google.com/u/0/+ArifulHaqueBhuiyan/">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Theme style -->
    <link href="{{ URL::to('/') }}/assets/theme/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ URL::to('/') }}/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- iCheck -->
    {{--<link href="{{ URL::to('/') }}/assets/theme/dist//plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />--}}



    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/assets/font-awesome/css/font-awesome.min.css">



    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.3.0/animate.min.css" rel="stylesheet" type="text/css">

</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="javascript:void(0)" title="Vend To Base"><b>Sleek</b>Docket</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body animated flipInX">

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
                    </div><!-- /.col -->
                    <div class="col-xs-6 col-lg-6 col-md-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Send Password
                        </button>
                    </div><!-- /.col -->
                </div>

            </form>


    </div><!-- /.login-box-body -->
    <div class="text-center">
        <br>
        {{--<p>API Integration between <a href="#">Vend</a> and <a href="#">Base CRM</a></p>--}}
        <br>
        <p><small>Developed by</small><br/><a href="http://www.launchstars.sg/" title="" target="_blank">Launchstars.sg</a></p>
    </div>
</div><!-- /.login-box -->

<script src="{{ URL::to('/') }}/bundle.js"></script>

</body>
</html>

