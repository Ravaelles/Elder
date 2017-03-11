<div class="hq-sidebar-content">

    <div class="hq-sidebar-content-title">
        <div class="hq-logo-wrapper">
            <img src="/img/ui/hq-logo.png" />
        </div>
        <!--<p>MENU</p>-->
    </div>

    <?php

    function sidebarSection($title)
    {
        return "</li><hr />

        <li class=\"section-title\">$title</li>";
    }

    function sidebarLink($title, $url, $routeBase, $fa, $newWindow = false)
{
        return "<li>
            <a href=\"$url\" class=\"hq-sidebar-element "
            . ($routeBase != null && Request::is($routeBase) ? "active" : "") . "\" "
        . ($newWindow ? "target='_blank'" : "") . "
            >
                <i class=\"fa fa-2x fa-$fa\"></i> <span>$title</span>
            </a>
        </li>";
    }
    ?>

    <ul>


        {!! sidebarLink('Dashboard', '/hq', 'hq', 'dashboard') !!}

        {{-- ############################################################################# --}}

        {!! sidebarSection('Dev section') !!}

        {!! sidebarLink('Logs', '/hq/logs', 'hq/logs*', 'book', true) !!}

        {{-- ############################################################################# --}}

        {!! sidebarSection('Account') !!}

        {!! sidebarLink('Logout', '/logout', '', 'sign-out') !!}

    </ul>

</div>