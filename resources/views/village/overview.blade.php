@extends('app')

@section('htmlheader_title')
- Band
@endsection

@section('contentheader_title')
@breadcrumbs('worldmap', 'Wasteland', 'Band')
@endsection

@section('load-engine-script') @endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        @include('village.partials.resources')
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @include('village.partials.persons')
    </div>
</div>
@endsection
