@extends('app')

<?php $disableContentHeader = true; ?>

@section('main-content')
<div class="worldmap fill-content"></div>

@include('worldmap.locations')

<!-- JavaScript -->
<script src="/js/worldmap/worldmap.js" type="text/javascript"></script>
@endsection