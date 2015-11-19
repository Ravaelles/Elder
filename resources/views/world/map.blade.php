@extends('app')

@section('htmlheader_title')
@endsection

@section('contentheader_title')
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-shadow world-map-canvas" id="canvas">
            @include ('world.units')
        </div>
    </div>
</div>
@endsection