@extends('app')

@section('htmlheader_title')
- Village
@endsection

@section('contentheader_title')
@breadcrumbs('map', 'Wasteland', 'Village')
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        @include('village.resources')
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @include('person.index')
    </div>
</div>
@endsection
