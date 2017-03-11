@section('load-worldmap-script')  @endsection
@section('disable-content-header') @endsection

@extends('app')

@section('main-content')
<div class="worldmap fill-content no-select">
    <div class="game-messages"></div>
</div>

<!-- Load locations -->
@include('worldmap.locations')

@endsection