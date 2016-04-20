@extends('app')

<?php $disableContentHeader = true; ?>

@section('main-content')
<div class="worldmap fill-content no-select"></div>

<!-- Load locations -->
@include('worldmap.locations')

@endsection