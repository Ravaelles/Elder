<!-- Overlay to show sidebar in the fullscreen layout -->
<div class="sidebar-fullscreen" style="">
    <!--display:none-->
    <!--<a href="{{ url('/home') }}" class="logo">-->
    <!-- mini logo for sidebar mini 50x50 pixels -->
        <!--<span class="logo-mini"><img src="/img/logo/logo.png" /></span>-->
    <!--</a>-->
    <img src="/img/logo/logo-mini.png" class="logo-mini" />
</div>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar no-select">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image" style='margin-left: 20px;'>
                <img src="{{ Auth::user()->unit_image }}" class="img-responsive" alt="User Image" />
            </div>
            <div class="pull-left info" style="padding-top: 10px;">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Band Elder</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <!--        <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
                </form>-->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

            <li class="header">Command us, oh mighty Elder!</li>

            <!-- World -->
            <!--            <li class="{{ Request::is('world*') ? "active" : "" }}">
                            <a href="/world"><div><i class='ion-planet'></i></div> <div>World</div></a>
                        </li>-->

            <!-- Map -->
            <li class="{{ Request::is('map*') ? "active" : "" }}">
                <a href="/map"><div><i class='ion-map'></i></div> <div>Map</div></a>
            </li>

<!--<li><a href="/map"><i class='fa fa-'></i> <span>Map</span></a></li>-->

<!--            <li><a href="/band"><i class='fa fa-link'></i> <span>Band</span></a></li>-->
            <!--            <li class="treeview">
                            <a href="#"><i class='fa fa-link'></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Link in level 2</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
                        </li>-->
        </ul><!-- /.sidebar-menu -->
    </section>

    <section class="game-log">
    </section>
    <!-- /.sidebar -->
</aside>