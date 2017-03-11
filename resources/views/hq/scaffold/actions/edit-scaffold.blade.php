@extends(config('scaffold.layout'))

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('html-title')
{!! $modelName !!}
@endsection

@section('title')
<a href="{{ route(config('laravel5-scaffold.route-base-name') . '.index', ['scaffold' => $modelName]) }}">
    {!! $modelName !!}s
</a>

<i class="fa fa-angle-right arrow"></i>

<a href="{{ route(config('laravel5-scaffold.route-base-name') . '.edit', 
            ['id' => $rawObject->getId(), 'scaffold' => $modelName]) }}">
    Edit
</a>
@endsection

@section('content')
@include('hq.scaffold.partials.error')

<div class="row">
    <div class="col-md-12">
        <form action="{{ route(config('laravel5-scaffold.route-base-name') . '.update', 
                    ['id' => $rawObject->getId(), 'scaffold' => $modelName]) }}" method="POST">

            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @include('hq.scaffold.partials.display-object', ['mode' => 'edit'])

            <div class="well well-sm mx6">

                <button type="submit" class="btn btn-primary">
                    Save
                </button>

                <a class="btn btn-default pull-right" 
                   href="{{ route(config('laravel5-scaffold.route-base-name') . '.index', ['scaffold' => $modelName]) }}">
                    <i class="fa fa-rotate-left"></i> <span>Back</span>
                </a>

            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<script>
$('.date-picker').datepicker({
});
</script>
@endsection
