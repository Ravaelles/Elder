@extends('auth.auth')

@section('htmlheader_title')
Get in!
@endsection

@section('content')
<body class="login-page">

    <!--<div class="login-box">-->
    <div class="login-logo">
        <a href="{{ url('/home') }}"><img src="/img/logo/logo.png" /></a>
    </div><!-- /.login-logo -->

    <div class="login-box fallout-terminal">

        @if (count($errors) > 0)
        <div class="alert alert-danger" id="validation-errors">
            <strong>Whoops!</strong> There were problems with your input. Are you radiated perhaps?<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        <script type="text/javascript">
            setTimeout(function() {
                $("#validation-errors").remove();
            }, 4000);
        </script>
        @endif

        <!--<div class="login-box-body">-->
        <div>
            <p class="login-box-msg">
                ROBCO INDUSTRIES (TM) TERMLINK PROTOCOL<br />
                ENTER PASSWORD NOW
            </p>
            <form action="{{ url('/auth/login') }}" method="post" id="form-login">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!--        <div class="form-group has-feedback">
                            <input type="email" class="form-control" placeholder="Email" name="email"/>
                    <i class='fa fa-lg fa-user form-control-feedback'></i>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                    <i class='fa fa-lg fa-lock form-control-feedback'></i>
                        </div>-->
                <div class="input-group">
                    <input type="email" class="form-control main-input" placeholder="Email" name="email"
                           required="required" value="{{ old('email') }}" />
                </div>
                <div class="input-group">
                    <input type="password" class="form-control main-input" placeholder="Password" name="password"
                           required="required" />
                </div>
                <div class="row login-box-buttons">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" id="submit" class="btn btn-primary btn-block btn-flat">
                            Sign In
                        </button>
                    </div><!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-xs-12 forgot-password-wrapper">
                        <a class="forgot-password" href="{{ url('password/email') }}">Forgot your password?</a> 
                        <br />
                        <a class="create-account-button" href="{{ url('auth/register') }}">Make account and start</a>
                    </div>
                </div>
            </form>

            <!--    <div class="social-auth-links text-center">
                    <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div> /.social-auth-links 
    
        <a href="{{ url('/password/email') }}">I forgot my password</a><br>
                <a href="{{ url('/auth/register') }}" class="text-center">Register a new membership</a>-->

        </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});

$("#form-login").submit(function () {
    changeColorsAndDoFancyStuff();
});

// =====================================

function changeColorsAndDoFancyStuff() {
    $(".login-logo").effect("shake");
    $(".login-box-body").css("background-color", "#00AABE");
    $(".login-box-body").css("box-shadow", "0 0 150px 120px #00AABE");
}
    </script>
</body>

@endsection
