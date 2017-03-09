@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">ItemTypes</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('itemTypes.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($itemTypes->isEmpty())
                <div class="well text-center">No ItemTypes found.</div>
            @else
                @include('itemTypes.table')
            @endif
        </div>

        @include('common.paginate', ['records' => $itemTypes])


    </div>
@endsection