@extends('app')

@section('htmlheader_title')
- Home
@endsection

@section('contentheader_title')
@breadcrumbs('wasteland', 'Wasteland', 'village', 'Village', 'Home')
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-fallout">
            Wasteland called for your bones. Rest In Peace, traveller.
        </div>
    </div>
</div>
@endsection
