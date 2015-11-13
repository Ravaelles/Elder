<!DOCTYPE html>
<html>

    @include('partials.htmlheader')

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

            @if (Auth::check())
            @include('partials.mainheader')

            @include('partials.sidebar')
            @endif

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                @include('partials.contentheader')

                <!--Container-fluid-->
                <div class="container-fluid">
                    <!-- Main content -->
                    <section class="content">
                        <!-- Your Page Content Here -->
                        @yield('main-content')
                    </section><!-- /.content -->
                </div><!-- /.container-fluid -->
            </div><!-- /.content-wrapper -->

            @include('partials.controlsidebar')

            @include('partials.footer')

        </div><!-- ./wrapper -->

        @include('partials.scripts')

    </body>
</html>