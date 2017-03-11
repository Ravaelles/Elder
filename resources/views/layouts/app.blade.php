<!DOCTYPE html>
<html>

    @include('partials.head')

<body class="skin-green sidebar-mini">
    <div class="wrapper">

        @include('partials.header')

        @include('hq.scaffold.layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content header -->
        @if (array_key_exists('disable-content-header', View::getSections()))
        <style>
            .content {
                margin: 0 !important;
                padding: 0 !important;
            }
        </style>
        @else
        @include('partials.contentheader')
        @endif

        <!-- Main content -->
        <section class="content">

            <!-- START OF Content -->
            @yield('main-content')
            <!-- END OF Content -->

        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->

    <!--@ include ('partials.controlsidebar')-->

    @include('partials.footer')

</div><!-- ./wrapper -->

@include('partials.scripts')

</body>
</html>