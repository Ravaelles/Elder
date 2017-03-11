@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($itemType, ['route' => ['itemTypes.update', $itemType->id], 'method' => 'patch']) !!}

        @include('itemTypes.fields')

    {!! Form::close() !!}
</div>
@endsection
