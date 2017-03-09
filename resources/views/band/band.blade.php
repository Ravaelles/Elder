@extends('app')

@section('htmlheader_title')
- Band
@endsection

@section('contentheader_title')
@breadcrumbs('worldmap', 'Wasteland', 'Band')
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        @include('band.resources')
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @include('person.persons')
    </div>
</div>
@endsection
