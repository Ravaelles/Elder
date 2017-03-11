@extends(config('scaffold.layout'))

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('html-title')
{!! $modelName !!}
@endsection

@section('title')
<a href="{{ route(config('scaffold.route-base-name') . '.index', ['scaffold' => $modelName]) }}">
    {{ $modelName }}s
</a>

<i class="fa fa-angle-right arrow"></i>

<a href="{{ route(config('scaffold.route-base-name') . '.show', 
            ['id' => $rawObject->getId(), 'scaffold' => $modelName]) }}">
    View
</a>
@endsection

@section('content')
@include('hq.scaffold.partials.error')

<div class="row">
    <div class="col-md-12">

        @include('hq.scaffold.partials.display-object', ['mode' => 'view'])

        <div class="well well-sm mx6">

            <a class="btn btn-default pull-right" 
               href="{{ route(config('scaffold.route-base-name') . '.index', ['scaffold' => $modelName]) }}">
                <i class="fa fa-rotate-left"></i> <span>Back</span>
            </a>

        </div>

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
