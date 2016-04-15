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
        background-color: rgba(0, 0, 0, 0.5);
        background-image: url("@image('map/map.jpg')");
        background-repeat: none;
        background-size: 100% 100%;
    }

    .worldmap * {
        cursor: pointer !important;
    }
</style>
@endsection