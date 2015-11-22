<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image" style='margin-left: 20px;'>
                <img src="{{ Auth::user()->critter_image }}" class="img-responsive" alt="User Image" />
            </div>
            <div class="pull-left info" style="padding-top: 10px;">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Village Elder</a>
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

            <li class="header">Command, oh, mighty Elder!</li>

            <li class="active"><a href="/village">
                    <div><i class='ion-bonfire'></i></div> <div>Village</div>
                </a></li>

            <li><a href="/world">
                    <div><i class='ion-planet'></i></div> <div>World</div>
                </a></li>

<!--<li><a href="/world"><i class='fa fa-'></i> <span>World</span></a></li>-->

<!--            <li><a href="/village"><i class='fa fa-link'></i> <span>Village</span></a></li>-->
            <!--            <li class="treeview">
                            <a href="#"><i class='fa fa-link'></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Link in level 2</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
                        </li>-->
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
