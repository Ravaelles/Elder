@extends('auth.auth')

@section('htmlheader_title')
    Register
@endsection

@section('content')

<body class="login-page">

    <!--<div class="login-box">-->
    <div class="login-logo">
        <a href="{{ url('/home') }}"><img src="/img/logo/logo.png" /></a>
    </div><!-- /.login-logo -->

    <div class="fallout-terminal-desk"></div>

    <div class="login-box fallout-terminal">

        @if (count($errors) > 0)
        <div class="alert alert-danger" id="validation-errors" style="margin-top: 50px;">
            Bloody geck, error!<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        <div class="fallout-terminal-content" style="display: none">

            <script type="text/javascript">
                setTimeout(function() {
                    $("#validation-errors").remove();
                }, 7000);
            </script>
            @endif

            <script type="text/javascript">
                window.initQueue.push(function () {
                    $(".fallout-terminal-content").fadeIn(2000);
                    $("#email").focus();
                });
            </script>
            <p class="login-box-msg">
                ROBCO INDUSTRIES (TM) TERMLINK PROTOCOL<br />
                CREATE NEW VAULT ACCOUNT:
            </p>
            <form action="{{ url('/auth/register') }}" method="post" id="form-login">
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
                    <input type="email" class="form-control main-input" placeholder="Your email" name="email"
                           required="required" value="{{ old('email') }}" id="email" />
                </div>
                <div class="input-group">
                    <input type="text" class="form-control main-input" placeholder="Name to use in game" name="name"
                           required="required" value="{{ old('name') }}" />
                </div>
                <div class="input-group">
                    <input type="password" class="form-control main-input" placeholder="Password" name="password"
                           required="required" />
                </div>
                <div class="input-group">
                    <input type="password" class="form-control main-input" placeholder="Confirm password" name="password_confirmation"
                           required="required" />
                </div>
                <div class="row login-box-buttons">
                    <div class="col-xs-4">
                        <button type="submit" id="submit" class="btn forgot-password login-big-font">
                            Create account
                        </button>
                    </div><!-- /.col -->
                    <div class="col-xs-3"></div>
                    <div class="col-xs-4">
                        <div class="col-xs-12 forgot-password-wrapper login-big-font"
                             style="padding-top: 15px; padding-left: 20px;">
                            <a class="forgot-password" href="{{ url('/') }}">Go back</a> 
                        </div>
                    </div>
                </div>
            </form>

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
