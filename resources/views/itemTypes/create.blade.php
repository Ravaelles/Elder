@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'itemTypes.store']) !!}

        @include('itemTypes.fields')

    {!! Form::close() !!}
</div>
@endsection
