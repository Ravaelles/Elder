<!DOCTYPE html>
<html lang="en">

    @include('partials.head')
    <link rel="stylesheet" href="/assets-hq/css/hq.css" />
    @yield('layout-scaffold-css')
    @yield('css')

    <body>

        <!--        <div id="header">
                    <div class="container">
                <nav class="row">
                            @ if (!empty($navbar))
                            @ yield('navbar')
                            @ else
                            @ include('partials.Nav.navbar-themes.navbar-antigua')
                            @ endif
                        </nav>
            </div>
                </div>-->

        <div class="hq" id="content" style="margin-bottom: -148px">
            <div class="container" id="main-container">
                <div class="row">

                    @if (!empty($message))
                    @include('hq.partials.message')
                    @endif

                    <!-- Left column -->
                    <div class="hq-sidebar" style="padding-top: 0px !important;">
                        @include('hq.scaffold.layout.sidebar')
                    </div>

                    <!-- Main content -->
                    <div class="hq-container">
                        <div class="row mbm">
                            <h3 class="hq-title">
                                @yield('html-title', 'HQ')
                                @yield('hq-title', '')
                                @yield('hq-navbar', '')
                            </h3>
                        </div>
                        <div class="hq-content" style="opacity:0">
                            <!--<div class="hq-content" style="">-->
                            <div class="hq-breadcrumbs mbs mls">
                                @yield('title')
                            </div>

                            @yield('content')
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('hq.scaffold.layout.scripts')

    </body>
</html>
