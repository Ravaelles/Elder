<?php
// Sometimes it happens we try to load page without middleware Auth. It returns weird error (template errors
// after trying to get Auth-ed user name etc. here we display nicer error and die.
//if (!Auth::check()) {
//    ? >
//    <div class="error-page">
//        <h2 class="headline text-red">Error</h2>
//        <div class="error-content" style="color: white">
//            <h3><i class="fa fa-warning text-red"></i> Critical error has occured.</h3>
//            <p>
//                <b>User is not authenticated and trying to access page that requires Auth.</b><br />
//
//                Please <a href='{{ \URL::previous() }}'>go back</a>
//                <br />
//                or <a href='{{ url('/home') }}'>return to home page</a>
//                    </p>
//            </div>
//        <p>
//            <center>
//                <img src="http://thestarryeye.typepad.com/.a/6a00d8341cdd0d53ef014e86b9b561970d-800wi" class="" />
//            </center>
//        </p>
//        </div><!-- /.error-page -->
//< ?php
//    die;
//}
?>

<!-- Main Header -->
<header class="main-header no-select">

    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="/img/logo/logo.png" /></span>
        <!-- logo for regular state and mobile devices -->
        <!--<span class="logo-lg"><b>Sign</b>It </span>-->
        <span class="logo-lg"><img src="/img/logo/logo.png" /></span>
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
                <!--                <li class="dropdown messages-menu">
                                     Menu toggle button 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 4 messages</li>
                        <li>
                             inner menu: contains the messages 
                            <ul class="menu">
                                <li> start message 
                                    <a href="#">
                                        <div class="pull-left">
                                             User Image 
                                            <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                                        </div>
                                         Message title and timestamp 
                                        <h4>
                                            Support Team
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                         The message 
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li> end message 
                            </ul> /.menu 
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                                </li>-->
                <!-- /.messages-menu -->

                <!-- Notifications Menu -->
                <!--                <li class="dropdown notifications-menu">
                                     Menu toggle button 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                             Inner Menu: contains the notifications 
                            <ul class="menu">
                                <li> start notification 
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li> end notification 
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                                </li>-->

                <!-- Tasks Menu -->
                <!--                <li class="dropdown tasks-menu">
                                     Menu Toggle Button 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 9 tasks</li>
                        <li>
                             Inner menu: contains the tasks 
                            <ul class="menu">
                                <li> Task item 
                                    <a href="#">
                                         Task title and progress text 
                                        <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                        </h3>
                                         The progress bar 
                                        <div class="progress xs">
                                             Change the css width attribute to simulate progress 
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li> end task item 
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                                </li>-->

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <!--<img src="{ { Auth::user()->unit_image } }" class="user-image" alt="That's you"/>-->
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <i class="fa fa-user"></i> <span></span>
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <a href="/user/settings">
                                <img src="{{ Auth::user()->unit_image }}" class="user-image-mainmenu" alt="User Image" />
                            </a>
                            <p>
                                {{ Auth::user()->name }}
                                <br />
                                <small>Member since {{ Auth::user()->registered() }}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!--                        <li class="user-body">
                                                    <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                                                </li>-->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/user/settings" class="btn btn-success btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="/auth/logout" onclick="showPleaseWait()" 
                                   class="btn btn-success btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <!--                <li>
                                    <a href="/settings" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    <a href="/user/settings"><i class="fa fa-gears"></i></a>
                                </li>-->
            </ul>
        </div>
    </nav>
</header>