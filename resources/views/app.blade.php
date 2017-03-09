<!DOCTYPE html>
<html>

@include('partials.htmlheader')

<body class="skin-green sidebar-mini">
    <div class="wrapper">

    @include('partials.mainheader')

    @include('partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @if(empty($disableContentHeader))
        @include('partials.contentheader')
        @else
        <style>
            .content {
                margin: 0 !important;
                padding: 0 !important;
            }
        </style>
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