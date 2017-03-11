@extends(config('scaffold.layout'))

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('html-title')
<a href="{{ route(config('scaffold.route-base-name') . '.index', ['scaffold' => $modelName]) }}">
    {{ $modelName }}s
</a>

<i class="fa fa-angle-right arrow"></i>

<a href="{{ route(config('scaffold.route-base-name') . '.create', ['scaffold' => $modelName]) }}">
    Create
</a>
@endsection

@section('content')
@include('hq.scaffold.partials.error')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route(config('scaffold.route-base-name') . '.store', 
                    ['scaffold' => $modelName]) }}" method="POST">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @include('hq.scaffold.partials.display-object', ['mode' => 'create'])

            <div class="well well-sm mx6">

                <button type="submit" class="btn btn-primary">
                    Create
                </button>

                <a class="btn btn-default pull-right" 
                   href="{{ route(config('scaffold.route-base-name') . '.index', ['scaffold' => $modelName]) }}">
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

<script type="text/javascript">
    $(document).ready(function () {
        $('.form-control').get(0).focus();
    });
</script>
@endsection
