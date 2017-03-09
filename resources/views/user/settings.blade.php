@extends('app')

@section('htmlheader_title')
Profile
@endsection

@section('contentheader_title')
Profile
@endsection

@section('main-content')
<div class="col-md-6 col-md-offset-3">
    <div class="nav-tabs-custom settings box-shadow">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#password" data-toggle="tab" aria-expanded="true">Password</a></li>
            <li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Profile</a></li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="password">
                @include('user.partials.password')
            </div><!-- /.tab-pane -->

            <div class="tab-pane" id="profile">
                @include('user.partials.profile')
            </div><!-- /.tab-pane -->

            <script type="text/javascript">
                window.initQueue.push(function() {
                    typeSounds();
                });
            </script>

        </div><!-- /.tab-content -->
    </div><!-- /.nav-tabs-custom -->
</div>
@endsection