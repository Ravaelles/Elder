@extends('layouts.app')

@section('htmlheader_title')
@endsection

@section('contentheader_title')
@endsection

@section('load-engine-script') @endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <script type="text/javascript">
            window.initQueue.push(function() {
                engineView = new EngineView(2000, 1500);
            });
        </script>
        @include('engine.partials.init-engine')
    </div>
</div>
@endsection