@extends('app')

<?php $disableContentHeader = true; ?>

@section('main-content')
<div class="worldmap fill-content"></div>

@include('worldmap.locations')

<style>
    .worldmap {
        overflow: hidden;
        width: 100%;
        min-width: 100%;
        background-color: black;
        background-image: url("@image('map/map.jpg')");
    }
</style>
@endsection