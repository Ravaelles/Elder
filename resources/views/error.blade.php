
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

    <head>
        <meta charset="UTF-8">
        <title> FElder @yield('htmlheader_title', 'Wasteland belongs to you') </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="/img/favicon.ico" />

        <!-- --- Fonts ---------------- -->

        <!-- Merged fonts styles -->
        <link href="{{ asset('/css/fonts.css') }}" rel="stylesheet" type="text/css" />

        <!-- Fallout terminal font -->
        <link href="http://fonts.googleapis.com/css?family=VT323" rel="stylesheet" type="text/css" />

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!--<link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">-->

        <!-- --- CSS ---------------- -->

        <!-- AdminLTE base styles. -->
        <link href="{{ asset('/css/admin-lte.css') }}" rel="stylesheet" type="text/css" />

        <!-- All stylesheets merged into one file -->
        <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />

        <!-- --- Top priority JS ---------------- -->

        <script>
            // Queue of functions to be loaded after window is loaded. It can be used without jQuery.
            window.initQueue = [];
        </script>

        <!--    
             Bootstrap 3.3.4 
            <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
             Font Awesome Icons 
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
             Ionicons 
            <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
             Theme style 
            <link href="{{ asset('/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
             AdminLTE Skins. We have chosen the skin-blue for this starter
                  page. However, you can choose any other skin. Make sure you
                  apply the skin class to the body tag so the changes take effect.
            
            <link href="{{ asset('/css/skins/skin-blue.css') }}" rel="stylesheet" type="text/css" />
             iCheck 
            <link href="{{ asset('/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />
        
             HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries 
             WARNING: Respond.js doesn't work if you view the page via file:// 
            [if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

    </head>


    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        An error occured
                        <small></small>
                    </h1>
                    <!--        <ol class="breadcrumb">
                                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                        <li class="active">Here</li>
                            </ol>-->
                </section>


                <!--Container-fluid-->
                <div class="container-fluid">
                    <!-- Main content -->
                    <section class="content">
                        <!-- Your Page Content Here -->
                        @yield('main-content')
                    </section><!-- /.content -->
                </div><!-- /.container-fluid -->

            </div><!-- ./wrapper -->

            <!-- REQUIRED JS SCRIPTS -->

            <!-- jQuery 2.1.4 -->
            <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
            <!-- Bootstrap 3.3.2 JS -->
            <script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
            <!-- iCheck -->
            <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>

            <script>
            //<!-- Pass CSRF token to every ajax request -->
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
            });

            //<!-- Process all listeners to be run after window is loaded -->
            $.each(window.initQueue, function (i, fn) {
                fn();
            });
            </script>

    </body>
</html>