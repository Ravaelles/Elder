@extends('auth.auth')

@section('htmlheader_title')
Get in!
@endsection

@section('content')
<audio controls autoplay style="display: none">
    @if (env("APP_ENV") === 'local')
    <source src="/sound/music/main-theme-40.mp3" type="audio/mpeg">
    @else
    <source src="http://picosong.com/cdn/77710e4fb076aecf7f5ba7a17ee61b69.mp3" type="audio/mpeg">
    @endif
</audio>
<audio controls autoplay style="display: none">
    <source src="/sound/terminal/comp-turn-on.mp3" type="audio/mpeg">
</audio>
<div style="display: none" id="audio"></div>


<body class="login-page">

    <!--<div class="login-box">-->
    <div class="login-logo" style="opacity: 0; transition: all 1s;">
        <a href="/"><img src="/img/logo/logo.png" /></a>
    </div><!-- /.login-logo -->

    <div class="fallout-terminal-desk"></div>

    <div class="login-box fallout-terminal">

        <!--<div class="login-box-body">-->
        <div class="fallout-terminal-content" style="display: none">

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
                }, 5000);
            </script>
            @endif

            <script type="text/javascript">
                window.initQueue.push(function() {
                    setTimeout(function() {
                        $(".fallout-terminal-content").fadeIn(2000);
                        $("#email").focus();
                    }, 1000);

                    setTimeout(function() {
                        $(".login-logo").fadeTo("slow", 1);
                    }, 2500);
                });
            </script>
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
                           required="required" value="{{ old('email') }}" id="email" />
                </div>
                <div class="input-group">
                    <input type="password" class="form-control main-input" placeholder="Password" name="password"
                           required="required" />
                </div>
                <div class="row login-box-buttons">
                    <div class="col-xs-8">
                        <div class="checkbox icheck login-big-font">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" id="submit" class="btn btn-primary btn-block btn-flat login-big-font">
                            Sign In
                        </button>
                    </div><!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-xs-12 forgot-password-wrapper login-big-font">
                        <!--                        <a class="forgot-password" href="{{ url('password/email') }}">Forgot your password?</a> 
                                                <br />-->
                        <br />
                        <a class="create-account-button" href="{{ url('auth/register') }}">Create new account!</a>
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
    
    function typeSound() {
        soundIndex = Math.floor((Math.random() * 5) + 1);
        $("#audio").html('<audio controls autoplay style="display: none" id="audio"><source src="/sound/terminal/type' + soundIndex + '.mp3" type="audio/mpeg"></audio>');
    }
    
//    $("input").keypress(function() {
//        console.log('ok');
//        typeSound();
//    });
    $('input').keyup(function(e) {
        typeSound();
    });
    $("label").click(function() {
        typeSound();
    });
    $("button").click(function() {
        typeSound();
    });
    $(".create-account-button").click(function() {
        typeSound();
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
