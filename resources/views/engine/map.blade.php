@extends('app')

@section('htmlheader_title')
@endsection

@section('contentheader_title')
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-shadow engine-canvas" id="canvas">
            @include ('engine.units')
        </div>
    </div>
</div>
@endsection